<?php

include '../models/product.php';




$controller = new productController();


if (isset($_REQUEST['method']) && $_REQUEST['method'] == "getProducts") {
    echo  $controller->getProducts();
}


if (isset($_REQUEST['method']) && $_REQUEST['method'] == "postProduct") {

    $nombre = htmlentities($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $referencia = htmlentities($_POST['referencia'], ENT_QUOTES, 'UTF-8');
    $precio = htmlentities($_POST['precio'], ENT_QUOTES, 'UTF-8');
    $peso = htmlentities($_POST['peso'], ENT_QUOTES, 'UTF-8');
    $categoria = htmlentities($_POST['categoria'], ENT_QUOTES, 'UTF-8');
    $stock = htmlentities($_POST['stock'], ENT_QUOTES, 'UTF-8');
    $date = date("Y-m-d");
    $controller->createProduct($nombre, $referencia, $precio, $peso,  $categoria, $stock, $date);
    header("Location: http://localhost://prueba_tecnica_php/index.php");
}

if (isset($_REQUEST['method']) && $_REQUEST['method'] == "deleteProduct") {

    $id = $_POST['id'];
    $controller->deleteProduct($id);
    header("Location: http://localhost://prueba_tecnica_php/index.php");
}


if (isset($_REQUEST['method']) && $_REQUEST['method'] == "getProduct") {

    $id = $_GET['id'];
    echo $controller->getProduct($id);
}

if (isset($_REQUEST['method']) && $_REQUEST['method'] == "getBestSeller") {

    echo $controller->getBestSeller();
}



if (isset($_REQUEST['method']) && $_REQUEST['method'] == "updateProduct") {


    $nombre = htmlentities($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $referencia = htmlentities($_POST['referencia'], ENT_QUOTES, 'UTF-8');
    $precio = htmlentities($_POST['precio'], ENT_QUOTES, 'UTF-8');
    $peso = htmlentities($_POST['peso'], ENT_QUOTES, 'UTF-8');
    $categoria = htmlentities($_POST['categoria'], ENT_QUOTES, 'UTF-8');
    $stock = htmlentities($_POST['stock'], ENT_QUOTES, 'UTF-8');
    $date = htmlentities($_POST['date'], ENT_QUOTES, 'UTF-8');
    $id = htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8');
    $controller->updateProduct($nombre, $referencia, $precio, $peso,  $categoria, $stock, $date,  $id);
    header("Location: http://localhost://prueba_tecnica_php/index.php");
}





class productController
{

    private $product;

    public function __construct()
    {
        $this->product = new product();
    }

    public function getProductsView()
    {

        include "public/views/getProducts.php";
    }

    public function getProduct($id)
    {
        $this->product = new product("", "", "", "", "", "", "", $id);
        return json_encode($this->product->getProductById());
    }

    public function getBestSeller()
    {

        return json_encode($this->product->getBestSeller());
    }



    public function getProducts()
    {
        return json_encode($this->product->getAllProducts());
    }


    public function createProduct($nombre, $referencia, $precio, $peso, $categoria, $stock, $date)
    {
        $this->product = new product($nombre, $referencia, $precio, $peso, $categoria, $stock, $date);
        $this->product->createProduct();
    }

    public function deleteProduct($id)
    {

        $this->product = new product("", "", "", "", "", "", "", $id);
        $this->product->deleteProductById();
    }

    public function updateProduct($nombre, $referencia, $precio, $peso, $categoria,  $stock, $date, $id)
    {
        $this->product = new product($nombre, $referencia, $precio, $peso, $categoria,  $stock, $date, $id);
        $this->product->updateProduct();
    }
}
