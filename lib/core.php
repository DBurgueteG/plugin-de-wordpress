<?php
    add_shortcode('participantes', 'run');

    function run(){
        $controlador = new Controlador();
        $controlador->run();
    }