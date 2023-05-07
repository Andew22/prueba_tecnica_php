<?php

#consultas a la base de datos

include '../database/connection.php';

class product
{

    private $connection;
    private $id;
    private $name;
    private $reference;
    private $price;
    private $weight;
    private $category;
    private $stock;
    private $date;



    public function __construct($name = "", $reference = "", $price = "", $weight = "", $category = "", $stock = "", $date = "", $id = 0)
    {

        $objectConexion =  new connection();
        $this->connection = $objectConexion->connect();
        $this->name = $name;
        $this->reference = $reference;
        $this->price = $price;
        $this->weight = $weight;
        $this->category = $category;
        $this->stock = $stock;
        $this->date = $date;
        $this->id = $id;
    }


    public function getAllProducts()
    {
        $querySQL = mysqli_query($this->connection, "SELECT * FROM producto");
        $datos = mysqli_fetch_all($querySQL, MYSQLI_ASSOC);
        return $datos;
    }


    public function getBestSeller()
    {
        $querySQL = mysqli_query($this->connection, "SELECT nombre, max(stock) as stock from producto GROUP BY id ORDER BY stock DESC LIMIT 1");
        $datos  = mysqli_fetch_assoc($querySQL);
        return  $datos;
    }

    public function getProductById()
    {
        $id = $this->id;
        $querySQL = mysqli_query($this->connection, "SELECT * FROM producto where id =" . $id);
        $datos  = mysqli_fetch_assoc($querySQL);
        return  $datos;
    }


    public function createProduct()
    {
        $name = $this->name;
        $reference = $this->reference;
        $price = $this->price;
        $weigth = $this->weight;
        $category = $this->category;
        $stock = $this->stock;
        $date = $this->date;
        $querySQL = mysqli_prepare($this->connection, "INSERT INTO producto(nombre,referencia,precio,peso,categoria,stock,fecha_de_creacion) VALUES(?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param($querySQL, "ssdisis", $name, $reference,  $price, $weigth, $category, $stock, $date);
        mysqli_stmt_execute($querySQL);
    }


    public function deleteProductById()
    {
        $id = $this->id;
        $querySQL = mysqli_prepare($this->connection, "DELETE FROM producto where id = ?");
        mysqli_stmt_bind_param($querySQL, "i", $id);
        mysqli_stmt_execute($querySQL);
    }

    public function updateProduct()
    {
        $name = $this->name;
        $reference = $this->reference;
        $price = $this->price;
        $weigth = $this->weight;
        $category = $this->category;
        $stock = $this->stock;
        $date = $this->date;
        $id = $this->id;
        $querySQL = mysqli_prepare($this->connection, "UPDATE producto SET nombre=?, referencia=?, precio=?, peso=?, categoria=?, stock=?, fecha_de_creacion=? WHERE id = ?");
        mysqli_stmt_bind_param($querySQL, "ssdisisi", $name, $reference, $price, $weigth, $category,  $stock, $date, $id);
        mysqli_stmt_execute($querySQL);
    }
}
