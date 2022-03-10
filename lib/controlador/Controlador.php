<?php
add_shortcode('nuevo_Participantes', '');

class Controlador
{
    public function run()
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

    public function mostrarFormulario($fase, $validador, $resultado)
    {
        include "../../vistas/nuevoParticipante.php";
    }

    public function crearReglasValidacion()
    {
        $reglas = array(
            "nombre" => array("required" => true, "maxLeng" => 150),
            "correo" => array("required" => true, "maxLeng" => 100, "formato" => "email"),
            "evento" => array("requiredEnviar" => true, "requiredRecuperar" => false),
            "lenguajes" => array("requiredEnviar" => true, "requiredRecuperar" => false)
        );
        return $reglas;
    }
}
