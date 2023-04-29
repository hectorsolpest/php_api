<?php
//headers
use models\Category;

header('Access-Control-Allow: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//instantiate db & connect
$database = new Database();
$db = $database->connect();

//instantiate blog post object
$category = new Category($db);

//get id
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

//get post
$category->read_single();

//create array
$category_arr = array(
    'id'=>$category->id,
    'name'=>$category->name,
    'created_at'=>$category->created_at,
);

//make json
echo json_encode($category_arr);
