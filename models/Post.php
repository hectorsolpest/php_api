<?php

namespace models;

class Post
{
    //db stuff
    private $connection;

    //post properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $create_at;

    //constructor with db
    public function __construct($db)
    {
        $this->connection = $db;
    }
    //get posts
    public function read()
    {
        //create query
        $query = "select
                    c.name as category_name,
                    p.id,
                    p.category_id,
                    p.title,
                    p.body,
                    p.author,
                    p.created_at
                    from
                        posts p
                    left join 
                        categories c on p.category_id = c.id
                        order by 
                            p.created_at desc";

        return $this->connection->query($query);
    }

    //get single post
    public function read_single()
    {
        //select by id query
        $query = "select
                    c.name as category_name,
                    p.id,
                    p.category_id,
                    p.title,
                    p.body,
                    p.author,
                    p.created_at
                    from
                        posts p
                    left join 
                        categories c on p.category_id = c.id
                    where
                        p.id =" . $this->id ." 
                    limit 0,1";

        $result = $this->connection->query($query);
        $post = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //set properties
        $this->title = $post[0]['title'];
        $this->body = $post[0]['body'];
        $this->author = $post[0]['author'];
        $this->category_name = $post[0]['category_name'];
    }

    //create post
    public function create()
    {
        $query = "insert into posts
                set
                    title = '$this->title',
                    body = '$this->body',
                    author = '$this->author',
                    category_id = '$this->category_id'";

        if($this->connection->query($query))
        {
            return true;
        }
        else
        {
            echo "Error: " . mysqli_error($this->connection->query($query));
            return false;
        }
    }

    //update post
    public function update()
    {
        $query = "update posts
                set
                    title = '$this->title',
                    body = '$this->body',
                    author = '$this->author',
                    category_id = '$this->category_id'
                where 
                    id = '$this->id'";

        if($this->connection->query($query))
        {
            return true;
        }
        else
        {
            echo "Error: " . mysqli_error($this->connection->query($query));
            return false;
        }
    }

    //delete post
    public function delete()
    {
        $query = "delete from posts where id = '$this->id'";

        if($this->connection->query($query))
        {
            return true;
        }
        else
        {
            echo "Error: " . mysqli_error($this->connection->query($query));
            return false;
        }
    }

}