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
// array $menuOpciones, $indicePalabras, $partida
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

            echo 'ingrese un numero de palabra para jugar:';

            $indicePalabras = cargarColeccionPalabras();

            $indiceElegido =  trim(fgets(STDIN)); // preguntar como limitar a los indicies del arreglo coleccionPalabras

            $partida = jugarWordix($indicePalabras[$indiceElegido], strtolower($usuarios));
            break;
        case 2: 
          echo 'ingrese su usuario: ';
          $usuarios = trim(fgets(STDIN));

          $indicePalabras = cargarColeccionPalabras();

          $partida = jugarWordix(array_rand($indicePalabras,1), strtolower($usuarios)); //array_rand selecciona un indice random
            break;
        case 3: 
            
          $resultadoPartidas = coleccionPartidas($partida);
          
          echo "Ingrese el número de partida: ";
          
          $numeroPartida = trim(fgets(STDIN));
          
          
          // echo $resultadoPartidas[$numeroPartida];
          
          /* foreach($resultadoPartidas as $numeroPartida) {
            echo $numeroPartida . "\n";
        } */


        /**
          aca empieza
         echo 'ingrese el numero de la partida';
        $numeroPartida = trim(fgets(STDIN));
        $partida[$numeroPartida]= [
        "partida Wordix" => $numeroPartida,
        "palabraWordix" => "MUJER",
        "jugador" => "jorge",
        "intentos" => "6",
        "puntaje" => "0"
        ];
      foreach ($partida as $estadisticas) {
     echo "Partida WORDIX {$estadisticas["partida Wordix"]}: palabra {$estadisticas["palabraWordix"]}\njugador: {$estadisticas["jugador"]}\npuntaje: {$estadisticas["puntaje"]}\n";
    }
  if ($partida[$numeroPartida]["puntaje"]==0) {
    echo 'Intento: No adivino la palabra';
  } elseif ($partida[$numeroPartida]["intentos"] ==1){
    echo "adivino la palabra en: {$partida[$numeroPartida]["intentos"]} intento";
  } else {
    echo "adivino la palabra en: {$partida[$numeroPartida]["intentos"]} intentos";
  }
*/

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