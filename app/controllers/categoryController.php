<?php

include '../models/category.php';


$controller = new categoryController();


if (isset($_REQUEST['method']) && $_REQUEST['method'] == "getCategories") {
    echo  $controller->getCategories();
}


if (isset($_REQUEST['method']) && $_REQUEST['method'] == "getCategory") {

    $id = $_GET['id'];
    echo $controller->getCategoriById($id);

}



if (isset($_REQUEST['method']) && $_REQUEST['method'] == "postCategory") {

    $nombre = htmlentities($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $controller->createCategory($nombre);
    header("Location: http://localhost://prueba_tecnica_php/app/views/viewCategories.php");
}


if (isset($_REQUEST['method']) && $_REQUEST['method'] == "deleteCategory") {

    $id = $_POST['id'];
    $controller->deleteCategoryById($id);
    header("Location: http://localhost://prueba_tecnica_php/app/views/viewCategories.php");
}



if (isset($_REQUEST['method']) && $_REQUEST['method'] == "updateCategory") {


    $nombre = htmlentities($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $id = htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8');
    $controller->updateCategory($nombre, $id);
    header("Location: http://localhost://prueba_tecnica_php/app/views/viewCategories.php");
}




class categoryController
{

    private $category;

    public function __construct()
    {
        $this->category = new category();
    }


    public function getCategories()
    {
        return json_encode($this->category->getAllCategories());
    }


    public function getCategoriById($id)
    {
        $this->category = new category("",$id);
        return json_encode($this->category->getCategoriById());
    }


    public function createCategory($nombre)
    {
        $this->category = new category($nombre);
        $this->category->createCategory();
    }



    public function deleteCategoryById($id)
    {
        $this->category = new category("",$id);
        $this->category->deleteCategoryById();
    }

    public function updateCategory($nombre,$id){
        $this->category = new category($nombre, $id);
        $this->category->updateCategory();
    }

    
}

