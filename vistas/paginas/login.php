<section class="breadcumd__banner">
    <div class="container">
        <div class="breadcumd__wrapper center">
            <h1 class="left__content">
            income
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
                income
                </li>
            </ul>
        </div>
    </div>
</section>

<div class="d-flex justify-content-center text-center">

    <form class="p-5 bg-light" method="post">
        <div class="form-group">
            <label for="email">Email address:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                </div>
                <input type="email" class="form-control" placeholder="Enter email" id="email" name="ingresoEmail">
            </div>
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                </div>
                <input type="password" class="form-control" placeholder="Enter password" id="pwd"
                    name="ingresoPassword">
            </div>
        </div>
        <?php
        $ingreso = new ControladorFormularios();
        $ingreso->ctrIngreso();
        ?>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>

</div>