<?php
    class ConexionBD{
        const PARTICIPANTES_LISTA = "tablaparticipantes";

        /**
         * Metodo que instala la tabla del plugin
         */
        public static function participantesInstala()
        {
            global $wpdb;
            $nombre_tabla = $wpdb->prefix.self::PARTICIPANTES_LISTA;
            $sql = "CREATE TABLE IF NOT EXISTS " . $nombre_tabla . " (nombreapellidos VARCHAR(150) NOT NULL, correo VARCHAR(100) NOT NULL, evento VARCHAR(50) NOT NULL, lenguajes VARCHAR(100) NOT NULL, PRIMARY KEY (correo)) ENGINE = InnoDB";
            $wpdb->query($sql);
        }

        /**
         * Metodo que desinstala la tabla del plugin
         */
        public static function participantesDesinstala(){
            global $wpdb;
            $nombre_tabla = $wpdb->prefix.self::PARTICIPANTES_LISTA;
            $sql = "DROP TABLE " . $nombre_tabla;
            $wpdb->query($sql);
        }

        /**
         * Metodo que añade un nuevo participante a la base de datos
         *
         * @param array $datos: todos los datos de $_POST del participante
         * @return Resultado de la inserción
         */
        public static function addParticipantes($datos){
            global $wpdb;
            $nombre_tabla = $wpdb->prefix.self::PARTICIPANTES_LISTA;
            return $wpdb->query("INSERT INTO " . $nombre_tabla . "(nombreapellidos, correo, evento, lenguajes) VALUES ('" . $datos['nombreapellidos'] . "', '" . $datos['correo'] . "', '" . $datos['evento'] . "', '" . $datos['lenguajes'] . "')");
        }

        /**
         * Metodo que recoge el resultado de la busqueda de un participante de la base de datos (exista o no)
         *
         * @param String $correo identificativo
         * @param String $nombreapellidos identificativos
         * @return array
         */
        public static function getParticipantes($correo, $nombreapellidos){
            global $wpdb;
            $nombre_tabla = $wpdb->prefix.self::PARTICIPANTES_LISTA;
            $participante = $wpdb->get_results("SELECT * FROM " . $nombre_tabla . " WHERE nombreapellidos='" . $nombreapellidos . "' AND correo='" . $correo . "'");
            return $participante;
        }
    }
?>