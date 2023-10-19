<?php
if (!isset($_SESSION["validarIngreso"])) {
    echo '<script>window.location = "index.php?pagina=ingreso";</script>';
    return;
}

$usuarios = ControladorFormularios::ctrSeleccionarRegistros(null, null);

?>

<section class="breadcumd__banner">
    <div class="container">
        <div class="breadcumd__wrapper center">
            <h1 class="left__content">
                Edit
            </h1>
            <ul class="right__content">
                <li>
                    <a href="index.php?pagina=inicio">
                        Home
                    </a>
                </li>
                <li>
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li>
                    Edit
                </li>
            </ul>
        </div>
    </div>
</section>

<div class="container-fluid">
    <div class="container py-5">
        <table class="table table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>E-MAIL</th>
                    <th>DATE</th>
                    <th>TOOLS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $key => $value): ?>
                    <tr>
                        <td>
                            <?php echo $key + 1; ?>
                        </td>
                        <td>
                            <?php echo $value["nombre"]; ?>
                        </td>
                        <td>
                            <?php echo $value["email"]; ?>
                        </td>
                        <td>
                            <?php echo $value["f"]; ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <div class="px-1">
                                    <a href="index.php?pagina=editar&token=<?php echo $value["token"]; ?>"
                                        class="btn btn-warning">
                                        <i class="fa-solid fa-user-pen"></i>
                                    </a>
                                </div>
                                <div class="px-1">
                                    <form method="post">
                                        <input type="hidden" value="<?php echo $value["token"]; ?>" name="deleteRegistro">
                                        <button type="submit" class="btn btn-danger">
                                        <i class="fa-solid fa-user-minus"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["deleteRegistro"])) {
    $tokenToDelete = $_POST["deleteRegistro"];
    $eliminar = new ControladorFormularios();
    $eliminar->ctrEliminarRegistro($tokenToDelete);
}
?>
