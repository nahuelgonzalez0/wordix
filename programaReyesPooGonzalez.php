<?php
include_once("wordix.php");

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/* ********* */

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

      $palabraJugar = verificarPalabraRepetida($indicePalabras, $usuarios, $resultadoPartidas);

      if ($palabraJugar != "fin") {
        $partida = jugarWordix($palabraJugar, strtolower($usuarios));
        $resultadoPartidas = coleccionPartidas($resultadoPartidas, $partida);
      }
      break;
    case 2:
      $usuarios = solicitarJugador();
      $palabraJugarRandom = verificaPalabraRandom($indicePalabras, $usuarios, $resultadoPartidas);

      if ($palabraJugarRandom != "fin") {
        $partida = jugarWordix($palabraJugarRandom, strtolower($usuarios));
        $resultadoPartidas = coleccionPartidas($resultadoPartidas, $partida);
      }
      break;
    case 3:
      echo "Ingrese el número de partida: ";

      $cantidad = count($resultadoPartidas); // devuelve la cantidad de elementos en el arreglo multidimensional $resultadoPartidas

      $numeroPartida = solicitarNumeroEntre(1, $cantidad);
      
      $indiceNumeroPartida = intval($numeroPartida);

      $indiceNumeroPartida--;

      mostrarColeccionPartidas($resultadoPartidas, $indiceNumeroPartida);
      break;
    case 4:
      $usuarios = solicitarJugador();

      $indiceGanador = primerPartidaGanadora($usuarios, $resultadoPartidas);

      mostrarColeccionPartidas($resultadoPartidas, $indiceGanador);
      break;
    case 5:
      $usuarios = solicitarJugador();

      $valorEstadistica = estadisticas($usuarios, $resultadoPartidas);

      estadisticaMensaje($valorEstadistica, $usuarios);
      break;
    case 6:
      imprimirPartidasOrdenandas($resultadoPartidas);
      break;
    case 7:

      $palabras = leerPalabra5Letras();

      $indicePalabras = agregarPalabra($indicePalabras, $palabras);
  }
} while ($opcion != 8);
