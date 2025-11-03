<?php

class ControladorAutentificacion {


    public function logout(){
        session_start();
        session_unset();
        session_destroy();

        header("Location: /");
        exit();
    }
}

?>