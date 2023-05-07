<?php
#realizamos la peticion de los productos
$urlCategories = "http://localhost/prueba_tecnica_php/app/controllers/productController.php?method=getCategories";
$responseCategories = json_decode(file_get_contents($urlCategories));

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
    <title>Cafetería Categorias</title>
    <link rel="icon" type="image/x-icon" href="icons/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <?php include 'includes/header.php' ?>
    <div class="container">
        <h1 class="text-center mt-5 mb-5">Categorias</h1>
        <form method="POST" action="../controllers/categoryController.php">
            <div class="form-row">
                <input type="hidden" name="method" value="postCategory">
                <div class="form-group col-md-12">
                    <input type="nombre" class="form-control" placeholder="Nombre Categoria" require name="nombre">
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <button type="submit" class="btn btn-primary mt-5 text-center mb-5">Crear Categoria</button>
            </div>
        </form>
        <div>
            <table class="table mt-5 text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th >Nombre</th>
                        <th >Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($responseCategories as $category) : ?>
                        <tr class="">
                            <th scope="row"><?= $category->id ?></th>
                            <td><?= $category->nombre ?></td>
                            <td class="d-flex align-items-center justify-content-center"><div class="row"><div class="col-sm6 mr-3" ><form method="POST" action="../controllers/categoryController.php" ><button style="margin:0px !important" type="submit" class="btn btn-primary mt-5 text-center mb-5 bg-danger ">Eliminar</button><input type="hidden" name="method" value="deleteCategory"><input type="hidden" name="id" value="<?= $category->id ?>"></form></div>
                            <div class="col-sm6 mr-3" ><a href="../views/updatedCategory.php?id=<?= $category->id ?>" style="margin:0px !important" type="submit" class="btn btn-primary mt-5 text-center mb-5 text-light">Actualizar</a><input type="hidden" name="method" value="updateProduct"></div>
                            </div></td>
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