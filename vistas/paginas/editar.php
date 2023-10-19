<?php
if (!isset($_SESSION["validarIngreso"]) || $_SESSION["validarIngreso"] !== "ok") {
    echo '<script>window.location = "index.php?pagina=ingreso";</script>';
    return;
}

if (isset($_GET["token"])) {
    $item = "token";
    $valor = $_GET["token"];

    $usuario = ControladorFormularios::ctrSeleccionarRegistros($item, $valor);
}
?>

<section class="breadcumd__banner">
    <div class="container">
        <div class="breadcumd__wrapper center">
            <h1 class="left__content">
                blog single
            </h1>
            <ul class="right__content">
                <li>
                    <a href="index.html">
                        Home
                    </a>
                </li>
                <li>
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li>
                    blog
                </li>
            </ul>
        </div>
    </div>
</section>

<div class="d-flex justify-content-center text-center">
    <form class="p-5 bg-light" method="post">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                </div>
                <input type="text" class="form-control" value="<?= $usuario["nombre"]; ?>" placeholder="Name"
                    id="name" name="updateName">
            </div>
        </div>
        <div class="form-group">
            <div anclas="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                </div>
                <input type="email" class="form-control" value="<?= $usuario["email"]; ?>"
                    placeholder="Enter email" id="email" name="updateEmail">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                </div>
                <input type="password" class="form-control" placeholder="Enter password" id="pwd" name="updatePassword">
                <input type="hidden" name="passwordActual" value="<?= $usuario["password"]; ?>">
                <input type="hidden" name="tokenUsuario" value="<?= $usuario["token"]; ?>">
            </div>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $actualizar = ControladorFormularios::ctrActualizarRegistro();
            if ($actualizar == "ok") {
                echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    </script>';
                echo '<div class="alert-success">El usuario ha sido actualizado</div>
                    <script>
                        setTimeout(function(){
                            window.location = "index.php?pagina=inicio";
                        }, 1600);
                    </script>';
            } else {
                echo '<script>
                if (window.history.replaceState){
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>';
                echo '<div class="alert-danger">Error al actualizar</div>';
            }
        }
        ?>

        <div class="d-flex justify-content-center text-center">
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
</div>
