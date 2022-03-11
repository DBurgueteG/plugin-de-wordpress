<?php
    class Utilidades{

        /**
         * Mantiene el valor introducido en una lista
         *
         * @param String $valor
         * @param String $valorMenu
         */
        public static function verificarLista($valor, $valorMenu){
            if($valor == $valorMenu){
                echo 'selected="selected"';
            }
        }
        
        /**
         * Mantiene el valor introducido en un boton
         *
         * @param array $valor
         * @param String $valorBoton
         */
        public static function verificarBotones($valor, $valorBoton){
            if(in_array($valorBoton, $valor)){
                echo 'checked="checked"';
            }
        }
    }