<?php
    add_shortcode('participantes', 'run');

    /**
     * Metodo que inicia la aplicacion del plugin
     */
    function run(){
        $controlador = new Controlador();
        $controlador->run();
    }