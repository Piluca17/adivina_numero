<?php
//Declaro variables
//$min=0;
//$max=0;
//$numero_propuesto=0;
//$jugada=0;
//$intentos=0;
//$resultado=0;



$opcion = $_POST['submit'] ?? null;
switch ($opcion){
    case "Reiniciar":
    case "Empezar":
        //Esto es el Input
        //Rango menor
        $min=0;
        //Número de intentos que le pasamos
        $intentos=$_POST['intentos'];
        $max= 2** $intentos;
        //Esto es el procesamiento
        $numero_propuesto= ($min+$max)/2;
        //Número de la jugada
        $jugada= 1;
        break;

    case "Jugar":
        //Obtener los valores de variables
        $min=$_POST['min'];
        $max=$_POST['max'];
        //Número de intentos que le pasamos
        $intentos=$_POST['intentos'];
        //Número de la jugada
        $jugada= $_POST['jugada'];
        //Número que ha salido en el caso de empezar y, este parámetro lo tenemos guardado en un input tipo hidden
        $numero_propuesto = $_POST['numero_propuesto'];

        //Leer resultado
        $resultado = $_POST['rtdo'];

       //Actualizar mínimo o máximo en función del resultado
        switch ($resultado){
            case ">":
                $min = $numero_propuesto;
                break;
            case "<":
                $max = $numero_propuesto;
                break;
            case "=":
                // TO DO falta implementar esta situación que será fin de juego
                //Enviamos la variable con texto
                header('Location:fin.php?msj=Has acertado');
                exit();
        }

        //PROCEDIMIENTO_____Actualizar las variables $numero_propuesta $jugada
        $jugada++;
            if ($jugada>$intentos){
                 header('Location:fin.php?msj=Te has quedado sin intentos');
                 exit();
            }
        //El numero_propuesto es la media de $min y $max
        $numero_propuesto = ($min+$max)/2;
        break;

     case "Volver";
     default:
         header('Location:index.php');
         exit();


}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego de adivina un número</title>
</head>
<body>
    <fieldset style="width:40%;background:bisque ">
        <legend>Empieza el juego</legend>
        <form action="jugar.php" method="POST" >
            <h2> El n&uacutemero es  <span style="color: blue"> <?=$numero_propuesto?></span> </h2>
            <h5> Jugada  <span style="color: blue"><?=$jugada?></span>  </h5>
            <h5> Actualmente te quedan   <span style="color: blue"> <?=$intentos-$jugada?></span> intentos </h5>

            <input type="hidden" value="10" name="intentos">
            <!--Creamos los valores tipo radio del formulario -->
        <fieldset>
            <legend>Indica c&oacutemo es el n&uacutemero qu&eacute has pensado</legend>
            <input type="radio" name="rtdo" checked value='>'> Mayor<br />
            <input type="radio" name="rtdo" value='<'> Menor<br />
            <input type="radio" name="rtdo" value='='> Igual<br />
        </fieldset>
        <hr />
            <!--Guardamos las variables para leer los resultados-->
        <input type="submit" value="Jugar" name="submit" >
        <input type="submit" value="Reiniciar" name="submit"  >
        <input type="submit" value="Volver" name="submit"  >
        <input type="hidden" name="max" value="<?=$max?>">
        <input type="hidden" name="min" value="<?=$min?>">
        <input type="hidden" name="numero_propuesto" value="<?=$numero_propuesto?>">
        <input type="hidden" name="intentos" value="<?=$intentos?>">
        <input type="hidden" name="jugada" value="<?=$jugada?>">
        </form>
    </fieldset>

</body>
</html>
