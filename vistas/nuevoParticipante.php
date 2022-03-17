<?php
    /**
     * Imprime los errores
     */
    if($fase == "error"){
        $errores = $validador->getErrores();
        if(!empty($errores)){
            echo "<div class='errores' />";
            foreach ($errores as $key => $value) {
                foreach ($value as $mensaje) {
                    echo $mensaje . "</br>";
                }
            }
            echo "</div>";
        }
    }
?>
<form id="form" action="" method="post">
    <div id="datos">
        <h3>Formulario para insertar un nuevo participante</h3>
        <label for="nombreapellidos">Nombre y apellidos</label>
        <input type="text" name="nombreapellidos" value="<?php echo Input::get('nombreapellidos')?>">
        <p><small>(Con el nombre basta, pero se agradece el apellido)</small></p>
        <label for="correo">Correo</label>
        <input type="email" name="correo" value="<?php echo Input::get('correo')?>">
        <label for="evento">Evento</label>
        <select name="evento">
            <?php
                $eventos = array("Winter Game Jam", "Spring Game Jam", "Summer Game Jam");
                foreach ($eventos as $evento){
                    echo '<option value="' . $evento . '"';
                    Utilidades::verificarLista(Input::get('evento'), $evento); 
                    echo '>' . $evento . '</option>';
                }
            ?>
        </select>
        <label for="otro">Lenguajes</label><br>
        <?php
            $lenguajes = array("PHP", "Java", "JavaScript", "C++", "C#", "Python", "Otro");
            
            foreach ($lenguajes as $lenguaje){
                echo '<input type="checkbox" name="lenguaje[]" value="' . $lenguaje .'" id="' . $lenguaje . '"';
                if(isset($_POST['lenguaje'])){
                    Utilidades::verificarBotones(Input::get('lenguaje'), $lenguaje);
                }
                echo "><label for='$lenguaje'>$lenguaje</label><br>";
            }
        ?>
        <input type="submit" name="enviar" value="Enviar">
        <input type="submit" name="recuperar" value="Recuperar">
    </div>
</form>
<?php
    /**
     * Imprime el resultado
     */
    if($fase == "continuar"){
        echo $resultado;
    }
?>