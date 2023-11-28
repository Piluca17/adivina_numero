<?php
//Declaro variables
//$min=0;
//$max=0;
//$numero_propuesto=0;
//$jugada=0;
//$intentos=0;
//$resultado=0;



$opcion = $_POST['submit'] ?? "Por url";
switch ($opcion){
    case "Empezar":
        $min=0;
        $intentos=$_POST['intentos'];
        $max= 2** $intentos;
        $jugada= 1;
        $numero_propuesto= ($min+$max)/2;
        break;

    case "Jugar":
        //Obtener los valores de variables
        $min=$_POST['min'];
        $max=$_POST['max'];
        $intentos=$_POST['intentos'];
        $jugada= $_POST['jugada'];
        $numero_propuesto = $_POST['numero_propuesto'];

        //Leer resultado
        $resultado = $_POST['resultado'];

       //Actualizar mínimo o máximo en función del resultado
        switch ($resultado){
            case "mayor":
                $min = $numero_propuesto;
                break;
            case "menor":
                $max = $numero_propuesto;
                break;
            case "igual":
                break;
        }
        //Actualizar las variables $numero_propuesta $jugada
        $numero_propuesto = ($min+$max)/2;
        $jugada++;
        break;
     case "Reiniciar";
     $resultado=0;
     $mensaje= "Empezamos de nuevo";
     break;
     case "Volver";
     break;
    default:
        $mensaje = "Vuelve a empezar";
        $resultado=0;
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego de adivina un número</title>
</head>
<body style="width: 60%;float:left;margin-left: 20%;">

<h3></h3>
<fieldset style="width:40%;background:bisque ">
    <legend>Empieza el juego</legend>
    <form action="jugar.php" method="POST" >
        <h2> El n&uacutemero es  <span style="color: blue"> <?=$numero_propuesto?></span> </h2>
        <h5> Jugada  <span style="color: blue"><?=$jugada?></span>  </h5>
        <h5> Actualmente te quedan   <span style="color: blue"> <?=$intentos-$jugada?></span> intentos </h5>

        <input type="hidden" value="10" name="intentos">
        <fieldset>
            <legend>Indica c&oacutemo es el n&uacutemero qu&eacute has pensado</legend>
            <input type="radio" name="rtdo" checked value='>'> Mayor<br />
            <input type="radio" name="rtdo" value='<'> Menor<br />
            <input type="radio" name="rtdo" value='='> Igual<br />
        </fieldset>
        <hr />
        <input type="submit" value="Jugar" name="submit" >
        <input type="submit" value="Reiniciar" name="submit"  >
        <input type="submit" value="Volver" name="submit"  >
        <input type="hidden" name="max" value="<?=$max?>">
        <input type="hidden" name="min" value="<?=$min?>">
        <input type="hidden" name="numero_propuesto" value="<?=$numero_propuesto?>">
        <input type="hidden" name="intentos" value="<?=$intentos?>">

    </form>
</fieldset>

</body>
</html>
