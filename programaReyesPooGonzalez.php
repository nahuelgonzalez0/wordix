<?php
/**
  # Materia 2023

en Introducción a la Programación
Tecnicatura en Desarrollo Web
Facultad de Informatica
Universidad Nacional del Comahue

# Integrantes del grupo

-**Marcos Nahuel Gonzalez** -legajo: FAI-4689 -mail: mnahuel.gonzalez@est.fi.uncoma.edu.ar -Github = nahuelgonzalez0

-**Jose Reyes** -legajo: FAI-3220 -mail: jose.reyes@est.fi.uncoma.edu.ar -Github = jovirecast

-**Santiago Poo** -legajo: FAI-3923 -mail: santiagoo.poo@est.fi.uncoma.edu.ar -Github = SantiagoPoo

-**url del repositorio wordix** - https://github.com/nahuelgonzalez0/wordix.git
 */

 include_once("wordix.php");

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/


/* ****COMPLETAR***** */



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
// array $menuOpciones, $indicePalabras
// int $valor, $indiceElegido
// float $opcion
// string $usuarios, $mensaje
// 

//Inicialización de variables:


//Proceso:


//$partida = jugarWordix("MELON", strtolower($usuario));
//print_r($partida);
//imprimirResultado($partida);



do {

$menuOpciones=[ "Menú de opciones", 
                "1) Jugar al wordix con una palabra elegida", 
                "2) Jugar al wordix con una palabra aleatoria", 
                "3) Mostrar una partida",
                "4) Mostrar la primer partida ganadora",
                "5) Mostrar resumen de Jugador",
                "6) Mostrar listado de partidas ordenadas por jugador y por palabra",
                "7) Agregar una palabra de 5 letras a Wordix", 
                "8) salir"];
    foreach($menuOpciones as $valor) {
        echo $valor . "\n";
    }

    $opcion = solicitarNumeroEntre(1,8);

    switch ($opcion) {
        case 1: 
            echo 'ingrese su usuario: ';
            $usuarios = trim(fgets(STDIN));

            $mensaje = escribirMensajeBienvenida($usuarios);

            echo 'ingrese un numero de palabra para jugar:';

            $indicePalabras = cargarColeccionPalabras();

            $indiceElegido =  trim(fgets(STDIN));

            $partida = jugarWordix($indicePalabras[$indiceElegido], strtolower($usuario));
            break;
        case 2: 
          echo 'ingrese su usuario: ';
          $usuarios = trim(fgets(STDIN));

          $mensaje = escribirMensajeBienvenida($usuarios);

          $indicePalabras = cargarColeccionPalabras();

          $partida = jugarWordix(array_rand($indicePalabras,1), strtolower($usuario)); //array_rand selecciona un indice random
            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
          case 4: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 5: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 6: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
  }while ($opcion != 8);
?>