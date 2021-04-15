<?php
global $abecedario1, $abecedario2;
$abecedario1 = [
    0   =>  ['a', 'A'],
    1   =>  ['b', 'B'],
    2   =>  ['c', 'C'],
    3   =>  ['d', 'D'],
    4   =>  ['e', 'E'],
    5   =>  ['f', 'F'],
    6   =>  ['g', 'G'],
    7   =>  ['h', 'H'],
    8   =>  ['i', 'I'],
    9   =>  ['j', 'J'],
    10  =>  ['k', 'K'],
    11  =>  ['l', 'L'],
    12  =>  ['m', 'M'],
    13  =>  ['n', 'N'],
    14  =>  ['ñ', 'Ñ'],
    15  =>  ['o', 'O'],
    16  =>  ['p', 'P'],
    17  =>  ['q', 'Q'],
    18  =>  ['r', 'R'],
    19  =>  ['s', 'S'],
    20  =>  ['t', 'T'],
    21  =>  ['u', 'U'],
    22  =>  ['v', 'V'],
    23  =>  ['w', 'W'],
    24  =>  ['x', 'X'],
    25  =>  ['y', 'Y'],
    26  =>  ['z', 'Z'],
];

$abecedario2 = [
    'a' => 0,   'A' => 0,
    'b' => 1,   'B' => 1,
    'c' => 2,   'C' => 2,
    'd' => 3,   'D' => 3,
    'e' => 4,   'E' => 4,
    'f' => 5,   'F' => 5,
    'g' => 6,   'G' => 6,
    'h' => 7,   'H' => 7,
    'i' => 8,   'I' => 8,
    'j' => 9,   'J' => 9,
    'k' => 10,  'K' => 10,
    'l' => 11,  'L' => 11,
    'm' => 12,  'M' => 12,
    'n' => 13,  'N' => 13,
    'ñ' => 14,  'Ñ' => 14,
    'o' => 15,  'O' => 15,
    'p' => 16,  'P' => 16,
    'q' => 17,  'Q' => 17,
    'r' => 18,  'R' => 18,
    's' => 19,  'S' => 19,
    't' => 20,  'T' => 20,
    'u' => 21,  'U' => 21,
    'v' => 22,  'V' => 22,
    'w' => 23,  'W' => 23,
    'x' => 24,  'X' => 24,
    'y' => 25,  'Y' => 25,
    'z' => 26,  'Z' => 26
];

function obtenerCifrado($mensaje, $clave, $rotacion)
{
    $abecedario1 = $GLOBALS['abecedario1'];
    $abecedario2 = $GLOBALS['abecedario2'];
    $clave = str_replace(' ', '', $clave);
    $clave = cadenaSinRepetidos($clave);
    $abecedario3 = nuevoAbecedario($abecedario1, $mensaje, $clave, $rotacion);
    $nuevoMensaje = cifrar($abecedario1, $abecedario2, $abecedario3, $mensaje, $clave, $rotacion);
    return $nuevoMensaje;
}

function nuevoAbecedario($abecedario1, $mensaje, $clave, $rotacion)
{
    $nuevoAbecedario = [];
    $longitudAbecedario = count($abecedario1);
    $longitudClave = strlen($clave);
    $segundoCiclo = true;
    $j = $longitudAbecedario - 1;
    $i = $rotacion - 1;
    while ($i >= 0) {
        $segundoCiclo = true;
        while ($j >= 0 && $segundoCiclo) {
            if (pertenece($abecedario1[$j][0], $clave) || pertenece($abecedario1[$j][1], $clave))
                $segundoCiclo = false;
            else if ($i >= 0) {
                $nuevoAbecedario[$i] = [$abecedario1[$j][0], $abecedario1[$j][1]];
                $i--;
            }
            $j--;
        }
    }
    $j = 0;
    $i = 0;
    while ($i < $longitudClave) {
        $nuevoAbecedario[$rotacion + $i] = [strtolower($clave[$i]), strtoupper($clave[$i])];
        $i++;
    }
    $j = 0;
    $i = $rotacion + $longitudClave;
    while ($i < $longitudAbecedario) {
        $segundoCiclo = true;
        while ($j < $longitudAbecedario && $segundoCiclo) {
            if (pertenece($abecedario1[$j][0], $clave) || pertenece($abecedario1[$j][1], $clave)) {
                $segundoCiclo = false;
            } else if ($i < $longitudAbecedario) {
                $nuevoAbecedario[$i] = [$abecedario1[$j][0], $abecedario1[$j][1]];
                $i++;
            }
            $j++;
        }
    }
    return $nuevoAbecedario;
}

function pertenece($letra, $clave)
{
    return strpos($clave, $letra) !== false;
}

function cifrar($abecedario1, $abecedario2, $abecedario3, $mensaje, $clave, $rotacion)
{
    $nuevoMensaje = "";
    $longitudMensaje = strlen($mensaje);
    for ($i = 0; $i < $longitudMensaje; $i++) {
        $caracter = $mensaje[$i];
        $valor = existe($abecedario2, $caracter);
        $nuevoValor = $valor;
        if (is_numeric($valor)) {
            $valor = ($valor + $rotacion) % 27;
            $nuevoValor = ctype_lower($caracter) ? $abecedario3[$valor][0] : $abecedario3[$valor][1];
        }
        $nuevoMensaje = $nuevoMensaje . $nuevoValor;
    }
    return $nuevoMensaje;
}

function existe($abecedario, $caracter)
{
    if ($abecedario[$caracter] === null) return $caracter;
    return $abecedario[$caracter];
}

function cadenaSinRepetidos($clave)
{
    $cadena = "";
    $longitudClave = strlen($clave);
    for ($i = 0; $i < $longitudClave; $i++) {
        $caracter = $clave[$i];
        $minuscula = strpos($cadena, strtoupper($caracter));
        $mayuscula = strpos($cadena, strtolower($caracter));
        if ($minuscula === false && $mayuscula === false && ctype_alpha($caracter))
            $cadena = $cadena . $caracter;
    }
    return $cadena;
}
