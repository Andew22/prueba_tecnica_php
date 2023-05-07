<?php

$id = $_GET['id'];
$urlProduct = "http://localhost/prueba_tecnica_php/app/controllers/productController.php?method=getProduct&id=" . $id;
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
    <link rel="icon" type="image/x-icon" href="icons/favicon.png">
    <title>Cafetería Actualizar Producto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <?php include 'includes/header.php' ?>
    <div class="container">
        <h1 class="text-center mt-5 mb-5">Actualizar Producto</h1>
        <form method="POST" action="../controllers/productController.php">
            <div class="form-row">
                <input type="hidden" name="method" value="updateProduct">
                <input type="hidden" name="id" value="<?= $responseProduct->id ?>">
                <input type="hidden" name="date" value="<?= $responseProduct->fecha_de_creacion ?>">
                <div class="form-group col-md-6">
                    <input type="nombre" class="form-control" placeholder="Nombre" require name="nombre" value="<?= $responseProduct->nombre ?>">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" maxlength="6" placeholder="Referencia" require name="referencia" value="<?= $responseProduct->referencia ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="precio" class="form-control" placeholder="Precio" require name="precio" value="<?= $responseProduct->precio ?>">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" maxlength="6" placeholder="Peso" require name="peso" value="<?= $responseProduct->peso ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <select id="inputState" class="form-control" require name="categoria" value="<?= $responseProduct->gategoria ?>">
                        <option disabled="disabled">---seleccione---</option>

                        <?php foreach ($responseCategories as $category) : ?>
                            <option <?= ($responseProduct->nombre == $category->nombre) ?  "selected" :  "selected"   ?> value="<?php echo $category->id ?>"><?php echo $category->nombre ?></a>
                            <?php endforeach ?>

                    </select>
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" maxlength="6" placeholder="Stock" require name="stock" value="<?= $responseProduct->stock ?>">
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <button type="submit" class="btn btn-primary mt-5 text-center mb-5 mr-5">Actualizar Producto</button>
                <a href="../../index.php" type="submit" class="btn btn-primary mt-5 text-center mb-5 text-light bg-secondary">Volver</a>
            </div>
        </form>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>