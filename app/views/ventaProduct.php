<?php
#realizamos la peticion de los productos
$urlProduct = "http://localhost/prueba_tecnica_php/app/controllers/productController.php?method=getProducts";
$responseProduct = json_decode(file_get_contents($urlProduct));

$urlVentas = "http://localhost/prueba_tecnica_php/app/controllers/ventasController.php?method=getVentas";
$responseVentas = json_decode(file_get_contents($urlVentas));



$limiteProducto = $_GET['limiteProducto'] ?? false;


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafetería Productos</title>
    <link rel="icon" type="image/x-icon" href="icons/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <?php include 'includes/header.php' ?>
    <div class="container">
        <h1 class="text-center mt-5 mb-5">Ventas</h1>
        <form method="POST" action="../controllers/ventasController.php">
            <div class="form-row">
                <input type="hidden" value="createVenta" name="method">
                <div class="form-group col-md-6">
                    <select id="inputState" class="form-control" required name="idProducto">
                        <option selected disabled="disabled">---Seleccione Producto---</option>

                        <?php foreach ($responseProduct as $producto) : ?>
                            <option value="<?php echo $producto->id ?>"><?php echo $producto->nombre ?></a>
                            <?php endforeach ?>

                    </select>
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control"  placeholder="Stock" required name="stock">
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <button type="submit" class="btn btn-primary mt-5 text-center mb-5">Realizar Venta</button>
            </div>
            <?php if ($limiteProducto=="true") : ?>
                <div class="alert alert-danger" role="alert">
                No es posible realizar la venta, ya que no hay stocks.
                </div>
            <?php endif; ?>
        </form><br>
        <div>
            <table class="table mt-5 text-center">
                <thead>
                    <tr>
                        <th scope="col">ID Producto</th>
                        <th scope="col">Nombre Producto</th>
                        <th scope="col">Stock Vendido</th>
                        <th scope="col">Fecha_venta</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($responseVentas as $venta) : ?>
                        <tr class="">
                            <td><?= $venta->producto ?></td>
                            <td><?php
                                $urlProducto = "http://localhost/prueba_tecnica_php/app/controllers/productController.php?method=getProduct&id=" . $venta->producto;
                                $responseProducto = json_decode(file_get_contents($urlProducto));
                                echo $responseProducto->nombre ?></td>
                            <td><?= $venta->stock ?></td>
                            <th><?= $venta->fecha_venta ?></th>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>