<?php
add_shortcode('nuevo_Participantes', '');

class Controlador
{
    public function run()
    {
        if (/*!isset($_POST) &&*/$_POST[""] == "empezar") //no se ha enviado el formulario
        { // primera petición
            //se llama al método para mostrar el formulario inicial
            $this->mostrarFormulario("validar", null, null);
            exit();
        } else if (/*!isset($_POST) &&*/$_POST[""] == "terminar") //no se ha enviado el formulario
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
            "correo" => array("required" => true, "maxLeng" => 100, "formato" => "email")
        );
        if (isset($_POST['enviar'])) {
            $reglas["evento"] = array("required" => true);
            $reglas["lenguajes"] = array("required" => true);  
        }

        return $reglas;
    }

    private function validar()
    {
        $validador = new ValidadorForm();
        $reglasValidacion = $this->crearReglasValidacion();
        $validador->validar($_POST, $reglasValidacion);
        if ($validador->esValido()) {
            $resultadoCosulta = $this->registrar();
            if (isset($_POST["recuperar"])) {
                if (is_array($resultadoCosulta)) {
                    $resultado = "Participante ";
                    $nombre = $resultadoCosulta['nombreapellidos'];
                    $resultado .= " $nombre ";
                    $resultado .= "<br /> <br />";
                    $correo = $resultadoCosulta['correo'];
                    $resultado .= "Correo: $correo <br /> <br />";
                    $evento = $resultadoCosulta['evento'];
                    $resultado .= "Evento: $evento";
                    $resultado .= "<br /> <br />";
                    $lenguajes = explode(",", $resultadoCosulta['lenguajes']);
                    $resultado .= "Lenguajes conocidos:<ul>";
                    foreach ($lenguajes as $valor) {
                        $resultado .= "<li class='listado'>" . $valor . "</li>";
                    }
                    $resultado .= "</ul>";
                    $resultado .= "<br /> <br />";
                } else {
                    $resultado = $resultadoCosulta;
                }
            } else if (isset($_POST["enviar"])) {
                $resultado = "";
            }
            $this->mostrarFormulario("Continuar", $validador, $resultado);
            exit();
        }
        $this->mostrarFormulario("Validar", $validador, null);
        exit();
    }
}
