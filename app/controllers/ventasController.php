<?php

include '../models/ventas.php';
include '../controllers/productController.php';



$controller = new ventasController();
$controller2 = new productController();


if (isset($_REQUEST['method']) && $_REQUEST['method'] == "getVentas") {
    echo  $controller->getAllVentas();
}


if (isset($_REQUEST['method']) && $_REQUEST['method'] == "getBestVentas") {
    echo  $controller->bestVentas();
}



if (isset($_REQUEST['method']) && $_REQUEST['method'] == "createVenta") {

    $id = htmlentities($_POST['idProducto'], ENT_QUOTES, 'UTF-8');
    $controller2->getProduct($id);
    $stock = htmlentities($_POST['stock'], ENT_QUOTES, 'UTF-8');
    $fecha_venta = date('d-m-y h:i:s');
    $producto = json_decode($controller2->getProduct($id));
    $nombre = $producto->nombre;
    $referencia = $producto->referencia;
    $precio = $producto->precio;
    $peso = $producto->peso;
    $categoria = $producto->categoria;
    $date = $producto->fecha_de_creacion;
    $stock2 = ($producto->stock >= $stock) ? ($producto->stock - $stock) : $producto->stock;
    if ($producto->stock>=$stock && $producto->stock!=0) {
        header("Location: http://localhost://prueba_tecnica_php/app/views/ventaProduct.php");
        $controller2->updateProduct($nombre, $referencia, $precio, $peso,  $categoria,  $stock2, $date, $id);
        $controller->createVenta($id, $stock, $fecha_venta);
    } else {
        header("Location: http://localhost://prueba_tecnica_php/app/views/ventaProduct.php?limiteProducto=true");
    }
}



class ventasController
{
    private $venta;


    public function __construct()
    {
        $this->venta = new ventas();
    }


    public function getAllVentas()
    {
        return json_encode($this->venta->getAllVentas());
    }


    public function createVenta($idProducto, $stock, $fecha_venta)
    {
        $this->venta = new ventas($idProducto, $stock, $fecha_venta);
        $this->venta->createVenta();
    }


    public function bestVentas(){

        return json_encode($this->venta->bestVentas());
    }

}
