<?php
include_once("wordix.php");

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/* ****COMPLETAR***** */

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
//array $menu, $indicePalabras, $partida, $resultadoPartidas, $estadisticaUsuario
//int $valor, $indiceElegido, $cantidad, $nuevoIndice
//float $opcion, $numeroPartida
//string $usuarios, $mensaje, $indiceRandom, $palabras, $indicePalabras

//Inicialización de variables:

$indicePalabras = cargarColeccionPalabras(); // Inicializa el arreglo con la coleccion de palabras del juego
$resultadoPartidas = cargarPartidas(); // Inicializa el arreglo con el historial de partidas

//Proceso:

do {
  $menu = seleccionarOpcion();

  echo "Ingrese una opcion: ";
  $opcion = solicitarNumeroEntre(1, 8);

  switch ($opcion) {
    //Switch corresponde a la estructura de controles alternativas (if, elseif)
    case 1:
      $usuarios = solicitarJugador();

      $cantidad = count($indicePalabras);

      echo "Hay $cantidad palabras cargadas, ingrese con cual que desea jugar: ";
      (int)$indiceElegido =  solicitarNumeroEntre(1, $cantidad);
 
      $partida = jugarWordix($indicePalabras[(int)$indiceElegido - 1], strtolower($usuarios));
      $resultadoPartidas = coleccionPartidas($resultadoPartidas, $partida);
 
      break;
    case 2:
      $usuarios = solicitarJugador();

      $indiceRandom = array_rand($indicePalabras); //array_rand selecciona un indice random

      $partida = jugarWordix($indicePalabras[$indiceRandom], strtolower($usuarios)); // $indicePalabras[$indiceRandom] devuelve la palabra de índice aleatorio como un string

      $resultadoPartidas = coleccionPartidas($resultadoPartidas, $partida);

      break;
    case 3:
      echo "Ingrese el número de partida: ";

      $cantidad = count($resultadoPartidas); // devuelve la cantidad de elementos en el arreglo multidimensional $resultadoPartidas

      $numeroPartida = solicitarNumeroEntre(1, $cantidad);

      mostrarColeccionPartidas($resultadoPartidas, $numeroPartida);

      break;
    case 4:
      $usuarios = solicitarJugador();

      primerPartidaGanadora($usuarios, $resultadoPartidas);
      break;
    case 5:
      $usuarios = solicitarJugador();

      estadisticas($usuarios, $resultadoPartidas);
      
      break;
    case 6:
      imprimirPartidasOrdenandas($resultadoPartidas);
      break;
    case 7:
      $palabras = leerPalabra5Letras();

      $indicePalabras = agregarPalabra($indicePalabras, $palabras);
  }
} while ($opcion != 8);
