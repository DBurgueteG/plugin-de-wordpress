<?php
    /**
     * Clase ValidadorForm
     * Se encarga de comprobar si el formulario es valido
     * si no lo es guarda sus errores
     */
    class ValidadorForm {
        private $errores;
        private $reglasValidacion;
        private $valido;

        /**
         * Constructor de la clase ValidadorForm
         */
        public function __construct(){
            $this->errores = array();
            $this->valido = false;
        }

        /**
         * Metodo que valida las consultas
         *
         * @param [type] $fuente
         * @param array $reglasValidacion
         * @return boolean
         */
        public function validar($fuente, $reglasValidacion){
            $this->reglasValidacion = $reglasValidacion;
            $filtro = new Input();
            foreach ($this->reglasValidacion as $campo => $reglasCampo) {
                $fuente[$campo] = $filtro::get($campo);
                foreach ($reglasCampo as $nombre => $regla) {
                    switch ($nombre) {
                        case 'required':
                            if($regla && $fuente[$campo] == ""){
                                $this->addError($campo, "El campo $campo es requerido");
                            }
                            break;
                        case 'maxLeng':
                            if(strlen($fuente[$campo]) > $regla){
                                $this->addError($campo, "El campo $campo excede el límite de caracteres: $regla");
                            }
                            break;
                        case 'formato':
                            if($regla == "email"){
                                if(!filter_var($fuente[$campo], FILTER_VALIDATE_EMAIL)){
                                    $this->addError($campo, "El formato del correo no es correcto");
                                }
                            }
                            break;
                    }
                }
            }
            if(count($this->errores) == 0)
                $this->valido = true;
        }

        

        /**
         * Get the value of valido
         */ 
        public function esValido()
        {
                return $this->valido;
        }
        /**
         * recupera el array de errores
         *
         * @return array
         */
        public function getErrores(){
            return $this->errores;
        }

        /**
         * Metodo que añade errores al array de errores
         *
         * @param string $campo
         * @param string $error
         * @return void
         */
        public function addError($campo, $error){
            if(in_array($campo, $this->errores)){
                $this->errores[$campo][] = $error;
            }
            else{
                $this->errores[$campo][] = $error;
            }
        }
    }