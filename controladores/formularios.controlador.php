<?php
class ControladorFormularios
{
    


    static public function crtRegistro(){
        if (isset($_POST["registerName"])) {
            $registerName = $_POST["registerName"];
            $registerEmail = $_POST["registerEmail"];
            $registerPassword = $_POST["registerPassword"];
        
            if (preg_match("/^[a-zA-Z ]+$/", $registerName) &&
                preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})+$/', $registerEmail) &&
                preg_match('/^[0-9a-zA-Z]+$/', $registerPassword)) {
        
                $tabla = "registros_mfma_wedding";

                $token = md5($_POST["registerName"] . "+" . $_POST["registerEmail"]);

                $encriptarPassword = crypt($registerPassword, '$2a$07$wwwinnovara3dcommacaws$');
        
                $datos = array( "token" => $token,
                    "nombre" => $registerName,
                    "email" => $registerEmail,
                    "password" => $encriptarPassword
                );
        
                $respuesta = ModeloFormularios::mdlRegistro($tabla, $datos);
                return $respuesta;
            } else {
                $respuesta = "error";
                return $respuesta;
            }
        }
        
    }
    
    static public function ctrSeleccionarRegistros($item, $valor)
    {
        if ($item == null && $valor == null) {
            $tabla = "registros_mfma_wedding";

            $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, null, null);

            return $respuesta;
        } else {
            $tabla = "registros_mfma_wedding";

            $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

            return $respuesta;
        }

    }
    
    public function ctrIngreso()
    {
        if (isset($_POST["ingresoEmail"])) {
            $ingresoPassword = $_POST["ingresoPassword"];
            $tabla = "registros_mfma_wedding";
            $item = "email";
            $valor = $_POST["ingresoEmail"];
    
            $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);
    
            $encriptarPassword = crypt($ingresoPassword, '$2a$07$wwwinnovara3dcommacaws$');
    
            if (is_array($respuesta)) {
                if ($respuesta["email"] == $_POST["ingresoEmail"] && $respuesta["password"] == $encriptarPassword) {
                    ModeloFormularios::mdlActualizarIntentosFallidos($tabla, 0, $respuesta["token"]);
    
                    $_SESSION["validarIngreso"] = "OK";
    
                    echo '<script>
                        if (window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                        window.location.href = "index.php?pagina=inicio";
                    </script>';
                } else {
                    if ($respuesta["intentos_fallidos"] < 3) {
                        $intentos_fallidos = $respuesta["intentos_fallidos"] + 1;
    
                        $actualizarIntentosFallidos = ModeloFormularios::mdlActualizarIntentosFallidos($tabla, $intentos_fallidos, $respuesta["token"]);
                    } else {
                        echo '<div class="alert alert-warning">VERIFICA QUE NO ERES UN ROBOT</div>';
                    }
    
                    echo '<script>
                        if (window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>';
                    echo '<div class="alert alert-danger">ERROR INTENTA DE NUEVO O COMUNICATE </div>';
                }
            } else {
                echo '<script>
                    if (window.history.replaceState){
                        window.history.replaceState(null, null, window.location.href);
                    }
                </script>';
                echo '<div class="alert alert-danger">ERROR INTENTA DE NUEVO O COMUNICATE ';
            }
        }
    }
    

    static public function ctrActualizarRegistro()
    {
        $actualizar = "error"; 
    
        if (isset($_POST["updateName"])) {
            $updateName = $_POST["updateName"];
            $updatePassword = $_POST["updatePassword"];
            $tokenUsuario = $_POST["tokenUsuario"];
    
            if (preg_match("/^[a-zA-Z ]+$/", $updateName) &&
                preg_match('/^[0-9a-zA-Z]+$/', $updatePassword)
            ) {
                $usuario = ModeloFormularios::mdlSeleccionarRegistros("registros_mfma_wedding", "token", $tokenUsuario);
    
                if ($usuario) {
                    $comparartoken = md5($usuario["nombre"] . "+" . $usuario["email"]);
    
                    if ($comparartoken == $tokenUsuario) {
                        
                        if (!empty($updatePassword)) {
                            
                            $hashedPassword = password_hash($updatePassword, PASSWORD_DEFAULT);
                        } else {
                           
                            $hashedPassword = $usuario["password"];
                        }
    
                        $tabla = "registros_mfma_wedding";
    
                        $datos = array(
                            "token" => $tokenUsuario,
                            "nombre" => $updateName,
                            "email" => $usuario["email"],
                            "password" => $hashedPassword 
                        );
    
                        $actualizar = ModeloFormularios::mdlActualizarRegistros($tabla, $datos);
                    }
                }
            }
        }
    
        return $actualizar;
    }
    
    
    public function ctrEliminarRegistro()
    {
        if (isset($_POST["deleteRegistro"])) {
            $tokenEliminar = $_POST["deleteRegistro"];
            $usuario = ModeloFormularios::mdlSeleccionarRegistros("registros_mfma_wedding", "token", $tokenEliminar);
            $comparartoken = md5($usuario["nombre"] . "+" . $usuario["email"]);
    
            if ($comparartoken == $tokenEliminar) {
                $tabla = "registros_mfma_wedding";
                $valor = $tokenEliminar;
    
                $respuesta = ModeloFormularios::mdlEliminarRegistro($tabla, $valor);
    
                if ($respuesta == "ok") {
                    echo '<script>
                    if (window.history.replaceState){
                        window.history.replaceState(null, null, window.location.href);
                    }
                    </script>    ';
                    echo '<div class="alert-success"> USUARIO ELIMINADO</div>
                        <script>
                        setTimeout(function(){
                        window.location = "index.php?pagina=inicio";
                        },3001);
                        </script>
                        ';
                }
            }
        }
    }
    

}

























