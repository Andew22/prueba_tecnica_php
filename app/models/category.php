<?php

#consultas a la base de datos

include '../database/connection.php';

class category
{

    private $connection;
    private $name;
    private $id;


    public function __construct($name = "", $id = 0)
    {
        $this->name = $name;
        $this->id  = $id;
        $objectConexion =  new connection();
        $this->connection = $objectConexion->connect();
    }


    public function getAllCategories()
    {
        $querySQL = mysqli_query($this->connection, "SELECT * FROM categoria");
        $datos = mysqli_fetch_all($querySQL,MYSQLI_ASSOC);
        return $datos;
    }

    public function getCategoriById()
    {
        $id = $this->id;
        $querySQL = mysqli_query($this->connection, "SELECT * FROM categoria WHERE id = ".$id);
        $datos  = mysqli_fetch_assoc($querySQL);
        return  $datos;

    }


    public function createCategory()
    {
        $name = $this->name;
        $querySQL = mysqli_prepare($this->connection, "INSERT INTO categoria(nombre) VALUES(?)");
        mysqli_stmt_bind_param($querySQL, "s", $name);
        mysqli_stmt_execute($querySQL);
        return $querySQL;
    }


    public function deleteCategoryById()
    {
        $id = $this->id;
        $querySQL = mysqli_prepare($this->connection, "DELETE FROM categoria where id = ?");
        mysqli_stmt_bind_param($querySQL, "i", $id);
        mysqli_stmt_execute($querySQL);
        return $querySQL;
    }

    public function updateCategory()
    {
        $name = $this->name;
        $id = $this->id;
        $querySQL = mysqli_prepare($this->connection, "UPDATE categoria SET nombre=? WHERE id = ?");
        mysqli_stmt_bind_param($querySQL, "si", $name, $id);
        mysqli_stmt_execute($querySQL);
    }
}


