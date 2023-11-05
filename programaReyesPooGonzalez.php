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
 
   $menuOpciones = [
     "\nMenú de opciones",
     "1) Jugar al wordix con una palabra elegida",
     "2) Jugar al wordix con una palabra aleatoria",
     "3) Mostrar una partida",
     "4) Mostrar la primer partida ganadora",
     "5) Mostrar resumen de Jugador",
     "6) Mostrar listado de partidas ordenadas por jugador y por palabra",
     "7) Agregar una palabra de 5 letras a Wordix",
     "8) salir"
   ];
   foreach ($menuOpciones as $valor) {
     echo $valor. "\n";
   }
   echo "Ingrese una opcion: ";
   $opcion = solicitarNumeroEntre(1, 8);
 
   switch ($opcion) {
     case 1:
       echo 'ingrese su usuario: ';
       $usuarios = trim(fgets(STDIN));
 
       echo "Ingrese el numero de la palabra que desea jugar: ";
       $indiceElegido =  trim(fgets(STDIN)); // preguntar como limitar a los indicies del arreglo coleccionPalabras
 
       $partida = jugarWordix($indicePalabras[$indiceElegido], strtolower($usuarios));
 
       $resultadoPartidas = coleccionPartidas($resultadoPartidas, $partida);
 
       break;
     case 2:
       echo 'ingrese su usuario: ';
       $usuarios = trim(fgets(STDIN));
 
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
       echo "Ingrese su nombre: ";
       $usuarios = trim(fgets(STDIN));

       primerPartidaGanadora($usuarios, $resultadoPartidas);
       break;
       
     case 5:
      echo "Ingrese el nombre del jugador: ";
      $usuario = trim(fgets(STDIN));
      
      $estadisticaUsuario = sumaPuntaje($usuario,$resultadoPartidas);
      estadisticas ($estadisticaUsuario,$usuario);
       break;
     case 6:
       //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3
 
       break;
 
       //...
   }
 } while ($opcion != 8);
 