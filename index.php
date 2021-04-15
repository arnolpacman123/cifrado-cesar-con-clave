<?php
include 'algoritmo.php';

global $mensaje, $clave, $rotacion;

if (isset($_POST['mensaje'])) {
    $mensaje = $_POST['mensaje'];
}

if (isset($_POST['clave'])) {
    $clave = $_POST['clave'];
}

if (isset($_POST['rotacion'])) {
    $rotacion = $_POST['rotacion'];
}

function formularioValido()
{
    $mensaje = $GLOBALS['mensaje'];
    $clave = $GLOBALS['clave'];
    $rotacion = $GLOBALS['rotacion'];
    return isset($mensaje) && strlen($mensaje) > 0 && isset($rotacion) && $rotacion !== "" && isset($clave) && strlen($clave) > 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cifrado de César con Clave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-success p-4">
            <h5 class="text-white h4">David García Romero</h5>
        </div>
    </div>
    <nav class="navbar navbar-dark bg-success">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h3 style="color: gainsboro;" class="ustify-content-center text-center">Criptografía y Seguridad</h3>
        </div>
    </nav>
    <h1 class="mt-4 text-center title">Cifrado de César con Clave</h1>
    <div class="container">
        <div class="abs-center">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="border p-3 form">
                <div class="form-group row">
                    <label for="mensaje" class="col-sm-2 col-form-label">Mensaje a cifrar</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="3" placeholder="Escriba el mensaje..."><?php if (isset($mensaje)) {
                                                                                                                                    echo $mensaje;
                                                                                                                                } ?></textarea><br><?php if (isset($mensaje) && strlen($mensaje) === 0) {
                                                                                                                                                    ?> <div class="alert alert-danger" role="alert">
                                Debe introducir un mensaje
                            </div> <?php }
                                    ?><br>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="clave" class="col-sm-2 col-form-label">Clave</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="clave" name="clave" placeholder="Escriba la clave..." <?php if (isset($clave)) {
                                                                                                                            ?> value="<?php echo trim($clave) ?>" <?php
                                                                                                                                                                } ?>><br><?php if (isset($clave) && strlen($clave) === 0) { ?>
                            <div class="alert alert-danger" role="alert">
                                Debe introducir una clave
                            </div><?php }
                                    ?><br>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="rotacion" class="col-sm-2 col-form-label">Rotación</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="rotacion" name="rotacion" aria-label="Default select example">
                            <option <?php if (!isset($rotacion)) {
                                    ?> selected <?php }  ?> value="">Seleccione el número de posiciones a recorrer</option>
                            <option <?php if (isset($rotacion) && $rotacion === "0") {
                                    ?> selected <?php }  ?> value="0">0</option>
                            <option <?php if (isset($rotacion) && $rotacion === "1") {
                                    ?> selected <?php }  ?> value="1">1</option>
                            <option <?php if (isset($rotacion) && $rotacion === "2") {
                                    ?> selected <?php }  ?> value="2">2</option>
                            <option <?php if (isset($rotacion) && $rotacion === "3") {
                                    ?> selected <?php }  ?> value="3">3</option>
                            <option <?php if (isset($rotacion) && $rotacion === "4") {
                                    ?> selected <?php }  ?> value="4">4</option>
                            <option <?php if (isset($rotacion) && $rotacion === "5") {
                                    ?> selected <?php }  ?> value="5">5</option>
                            <option <?php if (isset($rotacion) && $rotacion === "6") {
                                    ?> selected <?php }  ?> value="6">6</option>
                            <option <?php if (isset($rotacion) && $rotacion === "7") {
                                    ?> selected <?php }  ?> value="7">7</option>
                            <option <?php if (isset($rotacion) && $rotacion === "8") {
                                    ?> selected <?php }  ?> value="8">8</option>
                            <option <?php if (isset($rotacion) && $rotacion === "9") {
                                    ?> selected <?php }  ?> value="9">9</option>
                            <option <?php if (isset($rotacion) && $rotacion === "10") {
                                    ?> selected <?php }  ?> value="10">10</option>
                        </select><br>
                        <?php
                        if (isset($rotacion)) {
                            if (strlen($rotacion) === 0) {
                        ?>
                                <div class="alert alert-danger" role="alert">
                                    Debe seleccionar una rotación
                                </div>
                            <?php
                            } ?>
                        <?php
                        }
                        ?>
                    </div>
                </div><br>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10 col-xs-12 d-grid gap-2">
                        <button type="submit" name="submit" class="btn btn-danger mb-4">CIFRAR</button><br>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="clave-sin-repetidos" class="col-sm-2 col-form-label">Clave sin repetidos</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="clave-sin-repetidos" name="clave-sin-repetidos" <?php if (formularioValido()) {
                                                                                                                    ?> value="<?php echo cadenaSinRepetidos(str_replace(' ', '', trim($clave))); ?>" <?php
                                                                                                                                                                                                            } ?> readonly><br><br>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mensaje-cifrado" class="col-sm-2 col-form-label">Mensaje cifrado</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="mensaje-cifrado" name="mensaje-cifrado" rows="3" readonly><?php if (formularioValido()) {
                                                                                                                            echo obtenerCifrado($mensaje, $clave, $rotacion);
                                                                                                                        } ?></textarea><br><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <footer class="navbar-fixed-bottom footer">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            UAGRM - David García Romero © 2021 Copyright
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>