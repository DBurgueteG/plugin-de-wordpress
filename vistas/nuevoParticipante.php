<?php
    if(isset($_POST['enviar'])){
        /*$datos = array(
            'nombreapellidos' => $_POST['nombreapellidos'],
            'correo' => $_POST['correo'],
            'evento' => $_POST['evento']
        );

        $lenguajes = "";
        foreach ($_POST['lenguajes'] as $lenguaje) {
            $lenguajes .= $lenguajes . ",";
        }
        $lenguajes = substr($lenguajes, 0, strlen($lenguajes) - 2);

        $datos['lenguajes'] = $lenguajes;

        ConexionBD::addParticipante($datos);
        echo 'Se ha añadido el participante';*/
    }

    
?>
<form id="form" action="" method="post">
    <div id="datos">
        <h3>Formulario para insertar un nuevo participante</h3>
        <label for="nombreapellidos">Nombre y apellidos</label>
        <input type="text" name="nombreapellidos" required>
        <label for="correo">Correo</label>
        <input type="email" name="correo" required>
        <label for="evento">Evento</label>
        <select name="evento">
            <?php
                $eventos = array("Winter Game Jam", "Spring Game Jam", "Summer Game Jam");
                foreach ($eventos as $evento){
                    echo '<option value="' . $evento . '">' . $evento . '</option>';
                }
            ?>
        </select>
        <label for="otro">Lenguajes</label><br>
        <?php
            $lenguajes = array("PHP", "Java", "JavaScript", "C++", "C#", "Python", "Otro");
            
            foreach ($lenguajes as $lenguaje){
                echo '<input type="checkbox" name="lenguaje[]" value="' . $lenguaje .'" id="' . $lenguaje . "><label for='$lenguaje'>$lenguaje</label><br>";
            }
        ?>
        <input type="submit" name="enviar" value="Enviar">
        <input type="submit" name="recuperar" value="Recuperar">
    </div>
</form>
<?php
    if(isset($_POST['recuperar'])){
        
    }
?>