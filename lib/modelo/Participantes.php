<?php
    class Participante{
        private $nombreApellido;
        private $correo;
        private $evento;
        private $lenguajes;

        /**
         * Constructor de un participante
         *
         * @param String $nombreApellido
         * @param String $apellido
         * @param String $correo
         * @param String $rol
         * @param String $evento
         * @param String $equipo
         * @param String $rolEq
         * @param String $experiencia
         * @param String $lenguajes
         */
        public function __construct($nombreApellido, $correo, $evento, $lenguajes){
            $this->nombreApellido = $nombreApellido;
            $this->correo = $correo;
            $this->evento = $evento;
            $this->lenguajes = $lenguajes;
        }

        /**
         * Get the value of nombre
         */ 
        public function getNombreApellido()
        {
                return $this->nombreApellido;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombreApellido($nombreApellido)
        {
                $this->nombreApellido = $nombreApellido;

                return $this;
        }

        /**
         * Get the value of correo
         */ 
        public function getCorreo()
        {
                return $this->correo;
        }

        /**
         * Set the value of correo
         *
         * @return  self
         */ 
        public function setCorreo($correo)
        {
                $this->correo = $correo;

                return $this;
        }

        /**
         * Get the value of evento
         */ 
        public function getEvento()
        {
                return $this->evento;
        }

        /**
         * Set the value of evento
         *
         * @return  self
         */ 
        public function setEvento($evento)
        {
                $this->evento = $evento;

                return $this;
        }

        /**
         * Get the value of lenguajes
         */ 
        public function getLenguajes()
        {
                return $this->lenguajes;
        }

        /**
         * Set the value of lenguajes
         *
         * @return  self
         */ 
        public function setLenguajes($lenguajes)
        {
                $this->lenguajes = $lenguajes;

                return $this;
        }
    }
