<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver participantes</title>
</head>
<body>
    <div>
        <h3>Listado de Participantes</h3>
        <?php if($participantes):?>
        <div>
            <table>
                <tr>
                    <th>Nombre y apellidos</th>
                    <th>Correo</th>
                    <th>Evento</th>
                    <th>Lenguajes</th>
                </tr>
                <?php foreach($participantes as $participante){?>
                <tr>
                    <td><?php echo $empleado->nombreapellidos;?></td>
                    <td><?php echo $empleado->correo;?></td>
                    <td><?php echo $empleado->evento;?></td>
                    <td><?php echo $empleado->lenguajes;?></td>
                </tr>
                <?php }?>
            </table>
        </div>
        <?php endif;?>
        <?php echo "La ruta en la que está el archivo".plugin_dir_path(__FILE__)."<br>";?>
        <?php echo "Si se necesita la ruta con el archivo".plugin_dir_path(__FILE__."/verEmpleados.php")?>
    </div>
</body>
</html>