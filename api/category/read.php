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

//blog post query
$result = $category->read();


if($result)
{
    $category_arr = mysqli_fetch_all($result,MYSQLI_ASSOC);
    if(!empty($category_arr))
    {
        //turn to json & output
        echo json_encode($category_arr);
    }
    else
    {
        echo json_encode(array('message'=>'no categories found'));
    }
}
else
{
    echo 'Error: ' . mysqli_error($db);
}
