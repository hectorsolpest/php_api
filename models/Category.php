<?php

namespace models;

class Category
{
    private $connection;
    public $id;
    public $name;
    public $created_at;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    //get categories
    public function read()
    {
        //create query
        $query = "select * from categories order by created_at desc";
        return $this->connection->query($query);
    }

    //get single category
    public function read_single()
    {
        //select by id query
        $query = "select id, name, created_at from categories where id =" . $this->id ." limit 0,1";

        $result = $this->connection->query($query);
        $category = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //set properties
        $this->id = $category[0]['id'];
        $this->name = $category[0]['name'];
        $this->created_at = $category[0]['created_at'];
    }

    //create category
    public function create()
    {
        $query = "insert into categories set name = '$this->name'";

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

    //delete category
    public function delete()
    {
        $query = "delete from categories where id = '$this->id'";

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