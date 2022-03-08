<?php
add_shortcode('nuevo_Participantes', '');

class Controlador
{
    function run()
    {
        if (/*!isset($_POST) &&*/ $_POST[""] == "empezar") //no se ha enviado el formulario
        { // primera petición
            //se llama al método para mostrar el formulario inicial
            $this->mostrarFormulario("validar", null, null);
            exit();
        } else if (/*!isset($_POST) &&*/ $_POST[""] == "terminar") //no se ha enviado el formulario
        { // primera petición
            //se llama al método para mostrar el formulario inicial
            $this->mostrarFormulario("validar", null, null);
            exit();
        }
        exit();
    }

    function mostrarFormulario($fase, $validador, $resultado)
    {
        include "../../vistas/nuevoParticipante.php";
    }
}
