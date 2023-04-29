<?php
//headers
use models\Category;

header('Access-Control-Allow: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,
Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//instantiate db & connect
$database = new Database();
$db = $database->connect();

//instantiate blog post object
$category = new Category($db);

//get raw posted data
$data = json_decode(file_get_contents("php://input"));

$category->name = $data->name;

//create post
if($category->create())
{
    echo json_encode(array('message'=>'Category created'));
}
else
{
    echo json_encode(array('message'=>'Category not created'));
}
