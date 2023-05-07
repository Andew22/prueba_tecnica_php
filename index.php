<?php
#realizamos la peticion de los productos
$urlProduct = "http://localhost/prueba_tecnica_php/app/controllers/productController.php?method=getProducts";
$responseProduct = json_decode(file_get_contents($urlProduct));

#realizamos la peticion de las categorias
$urlCategories = "http://localhost/prueba_tecnica_php/app/controllers/categoryController.php?method=getCategories";
$responseCategories = json_decode(file_get_contents($urlCategories));






?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="app/views/icons/favicon.png">
    <title>Cafetería</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <?php include 'app/views/includes/header.php' ?>
    <div class="container">
        <h1 class="text-center mt-5 mb-5">Productos</h1>

        <div class="row">
            <div class="col-sm-6">
                <h6 class="bold">Producto que mas stocks tiene es : <?php $urlBest = "http://localhost/prueba_tecnica_php/app/controllers/productController.php?method=getBestSeller";
                                                                    $responseBest = json_decode(file_get_contents($urlBest));
                                                                    echo $responseBest->nombre . " y tiene : " . $responseBest->stock . " stocks "
                                                                    ?></h6>
            </div>
            <div class="col-sm-6">
                <h6>Producto Que Mas Se Ha Vendido Es : <?php $urlCategoriess = "http://localhost/prueba_tecnica_php/app/controllers/ventasController.php?method=getBestVentas";
                                                        $responseCategoriess = json_decode(file_get_contents($urlCategoriess));
                                                        echo $responseCategoriess[0]->nombre." ".$responseCategoriess[0]->total_stock;?></h6>
            </div>
        </div>
        <br>
        <br>
        <br>

        <form method="POST" action="app/controllers/productController.php">
            <div class="form-row">
                <input type="hidden" name="method" value="postProduct">
                <div class="form-group col-md-6">
                    <input type="nombre" class="form-control" placeholder="Nombre" require name="nombre">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" maxlength="6" placeholder="Referencia" require name="referencia">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="precio" class="form-control" placeholder="Precio" require name="precio">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" maxlength="6" placeholder="Peso" require name="peso">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <select id="inputState" class="form-control" require name="categoria">
                        <option selected disabled="disabled">---seleccione---</option>

                        <?php foreach ($responseCategories as $category) : ?>
                            <option value="<?php echo $category->id ?>"><?php echo $category->nombre ?></a>
                            <?php endforeach ?>

                    </select>
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" maxlength="6" placeholder="Stock" require name="stock">
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <button type="submit" class="btn btn-primary mt-5 text-center mb-5">Crear Producto</button>
            </div>
        </form>
        <div>
            <table class="table mt-5 text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Referencia</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Fecha de Creación</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($responseProduct as $product) : ?>
                        <tr class="">
                            <th scope="row"><?= $product->id ?></th>
                            <td><?= $product->nombre ?></td>
                            <td><?= $product->referencia ?></td>
                            <td><?= $product->precio ?></td>
                            <td><?= $product->peso ?></td>
                            <td><?php
                                $urlCategoria = "http://localhost/prueba_tecnica_php/app/controllers/categoryController.php?method=getCategory&id=" . $product->categoria;
                                $responseCategory = json_decode(file_get_contents($urlCategoria));
                                echo $responseCategory->nombre ?></td>
                            <td><?= $product->stock ?></td>
                            <td><?= $product->fecha_de_creacion ?></td>
                            <td>
                                <div class="row">
                                    <div class="col-sm6 mr-3">
                                        <form method="POST" action="app/controllers/productController.php"><button style="margin:0px !important" type="submit" class="btn btn-primary mt-5 text-center mb-5 bg-danger ">Eliminar</button><input type="hidden" name="method" value="deleteProduct"><input type="hidden" name="id" value="<?= $product->id ?>"></form>
                                    </div>
                                    <div class="col-sm6 mr-3"><a href="app/views/updatedProduct.php?id=<?= $product->id ?>" style="margin:0px !important" type="submit" class="btn btn-primary mt-5 text-center mb-5 text-light">Actualizar</a><input type="hidden" name="method" value="updateProduct"></div>
                                </div>
                            </td>
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