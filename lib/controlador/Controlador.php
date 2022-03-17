<?php

class Controlador
{
    /**
     * Metodo para correr la aplicación
     *
     * @return El formulario
     */
    public function run()
    {
        if (!isset($_POST["enviar"]) && !isset($_POST["recuperar"])) //no se ha enviado el formulario
        { // primera petición
            //se llama al método para mostrar el formulario inicial
            $this->mostrarFormulario("validar", null, null);
            exit();
        } else if (isset($_POST["recuperar"]) || isset($_POST["enviar"])) 
        {
            $this->validar();
            exit();
        }
        exit();
    }

    /**
     * Musestra el formulario
     *
     * @param String $fase
     * @param ValidadorForm $validador
     * @param String $resultado
     * @return La vista
     */
    public function mostrarFormulario($fase, $validador, $resultado)
    {
        include __DIR__."../../../vistas/nuevoParticipante.php";
    }

    /**
     * Array con las reglas de validación
     *
     * @return void
     */
    public function crearReglasValidacion()
    {
        $reglas = "";
        if (isset($_POST['enviar'])) {
            $reglas = array(
                "nombreapellidos" => array("required" => true, "maxLeng" => 150),
                "correo" => array("required" => true, "maxLeng" => 100, "formato" => "email"),
                "evento" => array("required" => true),
                "lenguaje" => array("required" => true)
            );
        } else {
            $reglas = array(
                "nombreapellidos" => array("required" => true, "maxLeng" => 150),
                "correo" => array("required" => true, "maxLeng" => 100, "formato" => "email")
            );
        }

        return $reglas;
    }

    /**
     * Metodo que llama al metodo validar de validador form y en caso 
     * de ser valido al metodo registrar, trata el resultado de la consulta
     *
     * @return void
     */
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
                    $resultado = "No se ha encontrado a " . Input::get("nombreapellidos") . " con correo " . Input::get("correo");
                }
                
            } else if (isset($_POST["enviar"])) {
                $resultado = $resultadoCosulta;
            }
            $this->mostrarFormulario("continuar", $validador, $resultado);
            exit();
        } else {
            $this->mostrarFormulario("error", $validador, null);
        }
        exit();
    }

    /**
     * Metodo registrar, en caso de querer insertar un nuevo participante lo inserta,
     * en caso de querer recuperar uno existente lo recupera
     *
     * @return String/array
     */
    public function registrar(){
        if (isset($_POST["recuperar"])) {
            return $this->manejarRecoger(Input::get('correo'), Input::get('nombreapellidos'));
        } else if (isset($_POST["enviar"])){
            $datos = array(
                'nombreapellidos' => Input::get('nombreapellidos'),
                'correo' => Input::get('correo'),
                'evento' => Input::get('evento')
            );
    
            $lenguajes = "";
            foreach (Input::get('lenguaje') as $lenguaje) {
                $lenguajes .= $lenguaje . ",";
            }
            $lenguajes = substr($lenguajes, 0, strlen($lenguajes) - 1);
    
            $datos['lenguajes'] = $lenguajes;
            return $this->manejarAñadir($datos);
        }
        
    }

    /**
     * Metodo auxiliar para manejar el resultado de añadir un dato
     * 
     * return String
     */
    private function manejarAñadir($consulta){
        $respuesta = ConexionBD::addParticipantes($consulta);
        return $respuesta === false?"No se ha podido añadir el participante":"Se ha añadido el participante";
    }

    /**
     * Metodo auxiliar para manejar el resultado de recuperar un dato
     * 
     * return array
     */
    private function manejarRecoger($correo, $nombreapellidos){
        $respuesta = ConexionBD::getParticipantes($correo, $nombreapellidos);
        if(sizeof($respuesta) == 0){
            return "No se ha encontrado a " . $nombreapellidos . " (" . $correo . ") en la base de datos";
        }
        else{
            $arrayResultado = array(
                "nombreapellidos" => "",
                "correo" => "",
                "eventos" => "",
                "lenguajes" => ""
            );
            foreach ($respuesta as $linea) {
                $arrayResultado["nombreapellidos"] = $linea->nombreapellidos;
                $arrayResultado["correo"] = $linea->correo;
                $arrayResultado["evento"] = $linea->evento;
                $arrayResultado["lenguajes"] = $linea->lenguajes;
            }
            return $arrayResultado;
        }
    }
}
