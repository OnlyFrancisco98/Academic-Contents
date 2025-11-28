<?php

class ControladorAutentificacion {


    public function logout(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        header("Location: ../views/pages/index.php");
        exit();
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $authController = new ControladorAutentificacion();
    $authController->logout();
}

?>