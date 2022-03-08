<?php
    class ConexionBD{
        const PARTICIPANTES_LISTA = "tablaparticipantes";

        public static function participantesInstala()
        {
            global $wpdb;
            $nombre_tabla = $wpdb->prefix.self::PARTICIPANTES_LISTA;
            $sql = "CREATE TABLE IF NOT EXISTS " . $nombre_tabla . " (nombreapellidos VARCHAR(150) NOT NULL, correo VARCHAR(100) NOT NULL, evento VARCHAR(50) NOT NULL, lenguajes VARCHAR(100) NOT NULL, PRIMARY KEY (correo)) ENGINE = InnoDB";
            $wpdb->query($sql);
        }

        public static function participantesDesinstala(){
            global $wpdb;
            $nombre_tabla = $wpdb->prefix.self::PARTICIPANTES_LISTA;
            $sql = "DROP TABLE " . $nombre_tabla;
            $wpdb->query($sql);
        }
    }
?>