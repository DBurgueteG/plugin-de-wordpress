<?php

/**
 * Clase Input
 * Se encarga del filtrado/saneamiento de datos y de comprobar
 * si se ha enviado el formulario
 */
class Input
{
    /**
     * Se encarga de filtar/sanear los datos
     * pasados por parámetro
     *
     * @param $dato
     * @return El dato filtrado/saneado
     */
    public static function get($dato)
    {
        if (isset($_POST[$dato])) {
            $dato = $_POST[$dato];
            $dato = Input::filtrarDato($dato);
        } else {
            $dato = "";
        }
        return $dato;
    }

    /**
     * Método auxiliar de get($dato) filtra/sanea el dato
     *
     * @param [type] $dato
     * @return void
     */
    public static function filtrarDato($dato)
    {
        if (is_string($dato)) {
            $dato = trim($dato);
            $dato = strip_tags($dato);
            $dato = htmlspecialchars($dato, ENT_QUOTES, 'UTF-8');
        } else if (is_array($dato)) {
            $arrayAuxiliar = array();
            foreach ($dato as $datoIndividual) {
                $datoIndividual = trim($datoIndividual);
                $datoIndividual = strip_tags($datoIndividual);
                $datoIndividual = htmlspecialchars($datoIndividual, ENT_QUOTES, 'UTF-8');
                $arrayAuxiliar[] = $datoIndividual;
            }
            $dato = $arrayAuxiliar;
        }
        return $dato;
    }

    /**
     * Devuelve true si el formulario a sido enviado
     * devlovera false en el caso contrario
     *
     * @return boolean
     */
    public static function siEnviado()
    {
        return (!empty($_POST)) ? true : false;
    }
}
