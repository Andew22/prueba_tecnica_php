<?php

#consultas a la base de datos

include '../database/connection.php';


class ventas
{

    private $connection;
    private $idProducto;
    private $stock;
    private $fecha_venta;



    public function __construct($idProducto = "", $stock = "", $fecha_venta = "")
    {
        $objectConexion =  new connection();
        $this->connection = $objectConexion->connect();
        $this->idProducto = $idProducto;
        $this->stock = $stock;
        $this->fecha_venta = $fecha_venta;
    }


    public function getAllVentas()
    {
        $querySQL = mysqli_query($this->connection, "SELECT * FROM ventas");
        $datos = mysqli_fetch_all($querySQL, MYSQLI_ASSOC);
        return $datos;
    }
    

    public function bestVentas()
    {
        $querySQL = mysqli_query($this->connection, "SELECT producto.nombre, SUM(ventas.stock) as total_stock, MAX(ventas.stock) as max_stock 
        FROM producto 
        JOIN ventas ON producto.id = ventas.producto 
        GROUP BY producto.nombre 
        ORDER BY total_stock DESC LIMIT 1;");
        
        $datos = mysqli_fetch_all($querySQL, MYSQLI_ASSOC);
        return $datos;
    }



    public function createVenta()
    {
        $idProducto = $this->idProducto;
        $stock = $this->stock;
        $fecha_venta = date('d-m-y-h:i:s');
        $querySQL = mysqli_prepare($this->connection, "INSERT INTO ventas(stock,fecha_venta,Producto) VALUES(?,?,?)");
        mysqli_stmt_bind_param($querySQL, "isi",  $stock, $fecha_venta, $idProducto);
        mysqli_stmt_execute($querySQL);
    }
}
