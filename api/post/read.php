<?php
//headers
use models\Post;

header('Access-Control-Allow: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//instantiate db & connect
$database = new Database();
$db = $database->connect();

//instantiate blog post object
$post = new Post($db);

//blog post query
$result = $post->read();


if($result)
{
    $posts_arr = mysqli_fetch_all($result,MYSQLI_ASSOC);
    if(!empty($posts_arr))
    {
        //turn to json & output
        echo json_encode($posts_arr);
    }
    else
    {
        echo json_encode(array('message'=>'no posts found'));
    }
}
else
{
 echo 'Error: ' . mysqli_error($db);
}