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
// array $menuOpciones, $indicePalabras, $partida
// int $valor, $indiceElegido
// float $opcion
// string $usuarios, $mensaje
// 

//Inicialización de variables:

$indicePalabras = cargarColeccionPalabras(); // Inicializa el arreglo con la coleccion de palabras del juego

$resultadoPartidas = cargarColeccionPartidas(); // Inicializa el arreglo con el historial de partidas

//Proceso:


//$partida = jugarWordix("MELON", strtolower($usuario));
//print_r($partida);
//imprimirResultado($partida);



do {
  $menu = seleccionarOpcion();

  echo "Ingrese una opcion: ";
  $opcion = solicitarNumeroEntre(1, 8);

  switch ($opcion) {
    case 1:
      $usuarios = validacionUsuario();

      $cantidad = count($indicePalabras);

      echo "Hay $cantidad palabras cargadas, ingrese con cual que desea jugar: ";
      $indiceElegido =  solicitarNumeroEntre(1, $cantidad);

      $partida = jugarWordix($indicePalabras[(int)$indiceElegido - 1], strtolower($usuarios));

      $resultadoPartidas = coleccionPartidas($resultadoPartidas, $partida);

      break;
    case 2:
      $usuarios = validacionUsuario();

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
      $usuarios = validacionUsuario();

      primerPartidaGanadora($usuarios, $resultadoPartidas);
      break;

    case 5:
      $usuarios = validacionUsuario();

      $estadisticaUsuario = sumaPuntaje($usuario, $resultadoPartidas);
      estadisticas($estadisticaUsuario, $usuario);
      break;
    case 6:
      uasort($resultadoPartidas, 'cmp'); // uasort — Ordena un array con una función de comparación definida por el usuario y mantiene la asociación de índices
      print_r($resultadoPartidas); // print_r — Imprime información legible para humanos sobre una variable
      break;

    case 7:
      $palabras = leerPalabra5Letras();

      array_push($indicePalabras, $palabras);
  }
} while ($opcion != 8);
