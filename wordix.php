<?php

/*
La librería JugarWordix posee la definición de constantes y funciones necesarias
para jugar al Wordix.
Puede ser utilizada por cualquier programador para incluir en sus programas.
*/

/**************************************/
/***** DEFINICION DE CONSTANTES *******/
/**************************************/
const CANT_INTENTOS = 6;

/*
    disponible: letra que aún no fue utilizada para adivinar la palabra
    encontrada: letra descubierta en el lugar que corresponde
    pertenece: letra descubierta, pero corresponde a otro lugar
    descartada: letra descartada, no pertence a la palabra
*/
const ESTADO_LETRA_DISPONIBLE = "disponible";
const ESTADO_LETRA_ENCONTRADA = "encontrada";
const ESTADO_LETRA_DESCARTADA = "descartada";
const ESTADO_LETRA_PERTENECE = "pertenece";

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 *Verifica que el usuario ingrese un numero y no una letra, en caso contrario se repite el ciclo while hasta que el usuario
 *ingrese un numero valido
 *@param float $min
 *@param float $max
 *@return float;
 */
function solicitarNumeroEntre($min, $max)
{
    //int $numero

    $numero = trim(fgets(STDIN));

    if (is_numeric($numero)) { //determina si un string es un número. puede ser float como entero.
        $numero  = $numero * 1; //con esta operación convierto el string en número.
    }

    while (!(is_numeric($numero) && (($numero == (int)$numero) && ($numero >= $min && $numero <= $max)))) {
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero = trim(fgets(STDIN));
        if (is_numeric($numero)) {
            $numero  = $numero * 1;
        }
    }
    return $numero;
}

/**
 * Escribir un texto en color ROJO
 * @param string $texto)
 */
function escribirRojo($texto)
{
    echo "\e[1;37;41m $texto \e[0m";
}

/**
 * Escrbir un texto en color VERDE
 * @param string $texto)
 */
function escribirVerde($texto)
{
    echo "\e[1;37;42m $texto \e[0m";
}

/**
 * Escrbir un texto en color AMARILLO
 * @param string $texto)
 */
function escribirAmarillo($texto)
{
    echo "\e[1;37;43m $texto \e[0m";
}

/**
 * Escrbir un texto en color GRIS
 * @param string $texto)
 */
function escribirGris($texto)
{
    echo "\e[1;34;47m $texto \e[0m";
}

/**
 * Escrbir un texto pantalla.
 * @param string $texto)
 */
function escribirNormal($texto)
{
    echo "\e[0m $texto \e[0m";
}

/**
 * Escribe un texto en pantalla teniendo en cuenta el estado.
 * @param string $texto
 * @param string $estado
 */
function escribirSegunEstado($texto, $estado)
{
    switch ($estado) {
        case ESTADO_LETRA_DISPONIBLE:
            escribirNormal($texto);
            break;
        case ESTADO_LETRA_ENCONTRADA:
            escribirVerde($texto);
            break;
        case ESTADO_LETRA_PERTENECE:
            escribirAmarillo($texto);
            break;
        case ESTADO_LETRA_DESCARTADA:
            escribirRojo($texto);
            break;
        default:
            echo " $texto ";
            break;
    }
}

/**
 *Le da mensaje de bienvenida al usuario
 *@param string $usuario
 */
function escribirMensajeBienvenida($usuario)
{
    echo "***************************************************\n";
    echo "** Hola ";
    escribirAmarillo($usuario);
    echo " Juguemos una PARTIDA de WORDIX! **\n";
    echo "***************************************************\n";
}

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "ARBOL", "ABETO", "ALAGO", "ALTAR", "MANOS"
    ];

    return ($coleccionPalabras);
}

/** 
 * Almacena las partidas del usuario
 * @return array
 */
function cargarColeccionPartidas() // modificado para que sea un arreglo multidimensional, por lo que los datos de la primer partida quedan como $coleccionPartida[0][*datos*]
{

    $coleccionPartida = array(
        array(
            "palabraWordix" => "MUJER",
            "jugador" => "Tulio",
            "intentos" => "1",
            "puntaje" => "15"
        ),
    );

    return $coleccionPartida;
}

/**
 * Verifica si la palabra ingresada por el usuario no contiene numeros ni caracteres especiales
 * @param string $cadena 
 * @return boolean 
 */
function esPalabra($cadena)
{
    //int $cantCaracteres, $i, boolean $esLetra
    $cantCaracteres = strlen($cadena);
    $esLetra = true;
    $i = 0;
    while ($esLetra && $i < $cantCaracteres) {
        $esLetra =  ctype_alpha($cadena[$i]);
        $i++;
    }
    return $esLetra;
}


/**
 * Le solicita al usuario una palabra de cinco letras y verifica que sea de cinco letras
 * @return string
 */
function leerPalabra5Letras()
{
    //string $palabra
    echo "Ingrese una palabra de 5 letras: ";
    $palabra = trim(fgets(STDIN));
    $palabra  = strtoupper($palabra); // convierte el string a mayúsculas

    while ((strlen($palabra) != 5) || !esPalabra($palabra)) { // verifica que el string palabra tenga 5 caractéres y no contiene números ni caracteres especiales
        echo "Debe ingresar una palabra de 5 letras:";
        $palabra = strtoupper(trim(fgets(STDIN))); // convierte el string a mayúsculas
    }
    return $palabra; //retorna la palabra ingresada
}


/**
 * Inicia una estructura de datos Teclado. La estructura es de tipo: ¿Indexado, asociativo o Multidimensional?
 *@return array
 */
function iniciarTeclado()
{
    //array $teclado (arreglo asociativo, cuyas claves son las letras del alfabeto)
    $teclado = [
        "A" => ESTADO_LETRA_DISPONIBLE, "B" => ESTADO_LETRA_DISPONIBLE, "C" => ESTADO_LETRA_DISPONIBLE, "D" => ESTADO_LETRA_DISPONIBLE, "E" => ESTADO_LETRA_DISPONIBLE,
        "F" => ESTADO_LETRA_DISPONIBLE, "G" => ESTADO_LETRA_DISPONIBLE, "H" => ESTADO_LETRA_DISPONIBLE, "I" => ESTADO_LETRA_DISPONIBLE, "J" => ESTADO_LETRA_DISPONIBLE,
        "K" => ESTADO_LETRA_DISPONIBLE, "L" => ESTADO_LETRA_DISPONIBLE, "M" => ESTADO_LETRA_DISPONIBLE, "N" => ESTADO_LETRA_DISPONIBLE, "Ñ" => ESTADO_LETRA_DISPONIBLE,
        "O" => ESTADO_LETRA_DISPONIBLE, "P" => ESTADO_LETRA_DISPONIBLE, "Q" => ESTADO_LETRA_DISPONIBLE, "R" => ESTADO_LETRA_DISPONIBLE, "S" => ESTADO_LETRA_DISPONIBLE,
        "T" => ESTADO_LETRA_DISPONIBLE, "U" => ESTADO_LETRA_DISPONIBLE, "V" => ESTADO_LETRA_DISPONIBLE, "W" => ESTADO_LETRA_DISPONIBLE, "X" => ESTADO_LETRA_DISPONIBLE,
        "Y" => ESTADO_LETRA_DISPONIBLE, "Z" => ESTADO_LETRA_DISPONIBLE
    ];
    return $teclado;
}

/**
 * Escribe en pantalla el estado del teclado. Acomoda las letras en el orden del teclado QWERTY
 * @param array $teclado
 */
function escribirTeclado($teclado)
{
    //array $ordenTeclado (arreglo indexado con el orden en que se debe escribir el teclado en pantalla)
    //string $letra, $estado
    $ordenTeclado = [
        "salto",
        "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "salto",
        "A", "S", "D", "F", "G", "H", "J", "K", "L", "Ñ", "salto",
        "Z", "X", "C", "V", "B", "N", "M", "salto"
    ];

    foreach ($ordenTeclado as $letra) {
        switch ($letra) {
            case 'salto':
                echo "\n";
                break;
            default:
                $estado = $teclado[$letra];
                escribirSegunEstado($letra, $estado);
                break;
        }
    }
    echo "\n";
};


/**
 * Escribe en pantalla los intentos de Wordix para adivinar la palabra
 * @param array $estruturaIntentosWordix
 */
function imprimirIntentosWordix($estructuraIntentosWordix)
{
    $cantIntentosRealizados = count($estructuraIntentosWordix);
    //$cantIntentosFaltantes = CANT_INTENTOS - $cantIntentosRealizados;

    for ($i = 0; $i < $cantIntentosRealizados; $i++) {
        $estructuraIntento = $estructuraIntentosWordix[$i];
        echo "\n" . ($i + 1) . ")  ";
        foreach ($estructuraIntento as $intentoLetra) {
            escribirSegunEstado($intentoLetra["letra"], $intentoLetra["estado"]);
        }
        echo "\n";
    }

    for ($i = $cantIntentosRealizados; $i < CANT_INTENTOS; $i++) {
        echo "\n" . ($i + 1) . ")  ";
        for ($j = 0; $j < 5; $j++) {
            escribirGris(" ");
        }
        echo "\n";
    }
    //echo "\n" . "Le quedan " . $cantIntentosFaltantes . " Intentos para adivinar la palabra!";
}

/**
 * Dada la palabra wordix a adivinar, la estructura para almacenar la información del intento 
 * y la palabra que intenta adivinar la palabra wordix.
 * Devuelve la estructura de intentos Wordix modificada con el intento.
 * @param string $palabraWordix
 * @param array $estruturaIntentosWordix
 * @param string $palabraIntento
 * @return array estructura wordix modificada
 */
function analizarPalabraIntento($palabraWordix, $estruturaIntentosWordix, $palabraIntento)
{
    $cantCaracteres = strlen($palabraIntento);
    $estructuraPalabraIntento = []; /*almacena cada letra de la palabra intento con su estado */
    for ($i = 0; $i < $cantCaracteres; $i++) {
        $letraIntento = $palabraIntento[$i];
        $posicion = strpos($palabraWordix, $letraIntento);
        if ($posicion === false) {
            $estado = ESTADO_LETRA_DESCARTADA;
        } else {
            if ($letraIntento == $palabraWordix[$i]) {
                $estado = ESTADO_LETRA_ENCONTRADA;
            } else {
                $estado = ESTADO_LETRA_PERTENECE;
            }
        }
        array_push($estructuraPalabraIntento, ["letra" => $letraIntento, "estado" => $estado]);
    }

    array_push($estruturaIntentosWordix, $estructuraPalabraIntento);
    return $estruturaIntentosWordix;
}

/**
 * Actualiza el estado de las letras del teclado. 
 * Teniendo en cuenta que una letra sólo puede pasar:
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_ENCONTRADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_DESCARTADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_PERTENECE
 * de ESTADO_LETRA_PERTENECE a ESTADO_LETRA_ENCONTRADA
 * @param array $teclado
 * @param array $estructuraPalabraIntento
 * @return array el teclado modificado con los cambios de estados.
 */
function actualizarTeclado($teclado, $estructuraPalabraIntento)
{
    foreach ($estructuraPalabraIntento as $letraIntento) {
        $letra = $letraIntento["letra"];
        $estado = $letraIntento["estado"];
        switch ($teclado[$letra]) {
            case ESTADO_LETRA_DISPONIBLE:
                $teclado[$letra] = $estado;
                break;
            case ESTADO_LETRA_PERTENECE:
                if ($estado == ESTADO_LETRA_ENCONTRADA) {
                    $teclado[$letra] = $estado;
                }
                break;
        }
    }
    return $teclado;
}

/**
 * Determina si se ganó una palabra intento posee todas sus letras "Encontradas".
 * @param array $estructuraPalabraIntento
 * @return bool
 */
function esIntentoGanado($estructuraPalabraIntento)
{
    $cantLetras = count($estructuraPalabraIntento);
    $i = 0;

    while ($i < $cantLetras && $estructuraPalabraIntento[$i]["estado"] == ESTADO_LETRA_ENCONTRADA) {
        $i++;
    }

    if ($i == $cantLetras) {
        $ganado = true;
    } else {
        $ganado = false;
    }

    return $ganado;
}

/**
 * Le marca el puntaje al usuario
 * @param string $palabra
 * @return int
 */
function obtenerPuntajeWordix($intentos, $palabra)
{
    //int $puntaje, $i
    //bolean $condicion
    //string $palabraSeparada, $diccionario

    //Inicialización de variables
    //$condicion = false;
    //$diccionario = cargarColeccionPalabras();
    //$puntaje = CANT_INTENTOS;

    if ($intentos <= 6) {
        $puntaje = (CANT_INTENTOS + 1) - $intentos;
    } else {
        $puntaje = 0;
    };

    /*while (!$condicion && $puntaje > 0) { //Para determinar el puntaje segun los intentos

        if ($palabra == $palabra) {
            $condicion = true;
        } else {
            $puntaje--;
        }
    }*/

    if ($puntaje > 0) { //Para determinar el puntaje según la letra
        $palabraSeparada = str_split($palabra);
        $abecedario[0] = ["A", "E", "I", "O", "U",];
        $abecedario[1] = ["B", "C", "D", "F", "G", "H", "J", "K", "L", "M"];
        $abecedario[2] = ["N", "Ñ", "P", "Q", "R", "S", "T", "V", "W", "X", "Y", "Z"];

        for ($i = 0; $i < 5; $i++) {
            if (in_array($palabra[$i], $abecedario[0])) {
                $puntaje = $puntaje + 1;
            } else if (in_array($palabraSeparada[$i], $abecedario[1])) {
                $puntaje = $puntaje + 2;
            } else {
                $puntaje = $puntaje + 3;
            }
        }
    }

    return $puntaje;
}


/**
 * Dada una palabra para adivinar, juega una partida de wordix intentando que el usuario adivine la palabra.
 * @param string $palabraWordix
 * @param string $nombreUsuario
 * @return array estructura con el resumen de la partida, para poder ser utilizada en estadísticas.
 */
function jugarWordix($palabraWordix, $nombreUsuario)
{
    /*Inicialización*/
    $arregloDeIntentosWordix = [];
    $teclado = iniciarTeclado();
    escribirMensajeBienvenida($nombreUsuario);
    $nroIntento = 1;
    do {

        echo "Comenzar con el Intento " . $nroIntento . ":\n";
        $palabraIntento = leerPalabra5Letras();
        $indiceIntento = $nroIntento - 1;
        $arregloDeIntentosWordix = analizarPalabraIntento($palabraWordix, $arregloDeIntentosWordix, $palabraIntento);
        $teclado = actualizarTeclado($teclado, $arregloDeIntentosWordix[$indiceIntento]);
        /*Mostrar los resultados del análisis: */
        imprimirIntentosWordix($arregloDeIntentosWordix);
        escribirTeclado($teclado);
        /*Determinar si la plabra intento ganó e incrementar la cantidad de intentos */

        $ganoElIntento = esIntentoGanado($arregloDeIntentosWordix[$indiceIntento]);
        $nroIntento++;
    } while ($nroIntento <= CANT_INTENTOS && !$ganoElIntento);


    if ($ganoElIntento) {
        $nroIntento--;
        $puntaje = obtenerPuntajeWordix($nroIntento, $palabraWordix); // hay que cambiar las variables de entrada, que contemple los intentos
        echo "Adivinó la palabra Wordix en el intento " . $nroIntento . "!: " . $palabraIntento . " Obtuvo $puntaje puntos!";
    } else {
        $nroIntento = 0; //reset intento
        $puntaje = 0;
        echo "Seguí Jugando Wordix, la próxima será! ";
    }

    $partida = [
        "palabraWordix" => $palabraWordix,
        "jugador" => $nombreUsuario,
        "intentos" => $nroIntento,
        "puntaje" => $puntaje
    ];

    return $partida;
}


/**
 * Incorpora una partida a la colección de partidas jugadas
 * @param array $partida
 * @return 
 *  */


function coleccionPartidas($colePartidas, $partida)
{

    array_push($colePartidas, $partida); // MODIFICADO PARA QUE HAGA EL ARREGLO

    return $colePartidas; // devuelve el arreglo multidimensional agregando un nuevo indice para cada nueva iteración del arreglo $partida, siempre lo incorpora al final
}

/**
 * Devuelve las partidas jugadas según su número de partida
 * @param int $partidaNumero
 * @param array $listadoPartidas
 */

function mostrarColeccionPartidas($listadoPartidas, $partidaNumero) // $listadoPartidas es el arreglo de la colección y $partidaNumero el índice que opera de número de partida
{

    $partidaNumero = $partidaNumero - 1; // Al numero ingresado por el usuario se le resta 1 para que coincida con el índice del arreglo $listadoPartidas

    echo "***************************************************\n"; // separador estético
    echo "Partida WORDIX " . "$partidaNumero" . ": " . "palabra " . $listadoPartidas[$partidaNumero]["palabraWordix"] . "\n"; //muestra el numero de partida y la palabra usada
    echo "Jugador: " . $listadoPartidas[$partidaNumero]["jugador"] . "\n"; // muestra el nombre del jugador en el índice ingresado
    echo "puntaje: " . $listadoPartidas[$partidaNumero]["puntaje"] . " puntos" . "\n"; // muestra el puntaje obtenido en el índice ingresado
    if ($listadoPartidas[$partidaNumero]["puntaje"] == 0) {
        echo 'Intento: No adivino la palabra'; // muestra en caso de que no se adivine la palabra durante la partida
    } elseif ($listadoPartidas[$partidaNumero]["intentos"] == 1) {
        echo "adivino la palabra en: {$listadoPartidas[$partidaNumero]["intentos"]} intento"; // muestra si el intento es 1 (en singular la palabra intento)
    } else {
        echo "adivino la palabra en: {$listadoPartidas[$partidaNumero]["intentos"]} intentos"; // muestra el mensaje si los intentos fueron más (palabra intento en plural)
    }
    echo "\n"; // espacio luego del texto, para no agregarlo en cada if/elseif/else.
    echo "***************************************************\n"; // separador estético
}

/**
 * Devuelve la primer partida ganadora
 * @param string $nombre 
 * @param array $partidaListado
 */
function primerPartidaGanadora($nombre, $partidaListado)
{
    //boolean $partidaGandora
    //int $contador

    $partidaGanadora = null;

    foreach ($partidaListado as $indice => $partida) { //$indice representa el índice del arreglo $partidaListado y $partida representa los valores asociado al índice
        if (array_key_exists("jugador", $partida) && $partida["jugador"] === $nombre && $partida["puntaje"] > 0) {
            //Verificamos que el jugador exista en la partida y que la partida sea del jugador, además que su puntaje sea mayor a 0
            
            $partidaGanadora = $partida;
            mostrarColeccionPartidas($partidaListado, $indice + 1);
            break;
        }
    }

    if ($partidaGanadora === null) {
        echo "El jugador $nombre no gano ninguna partida.\n";
    }
}
