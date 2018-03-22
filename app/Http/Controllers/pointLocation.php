<?php
/*
Descripción: El algoritmo del punto en un polígono permite comprobar mediante
programación si un punto está dentro de un polígono o fuera de ello.
Autor: Michaël Niessen (2009)
Sito web: AssemblySys.com
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pointLocation {
    var $pointOnVertex = true; // Checar si el punto se encuentra exactamente en uno de los vértices?

    function pointLocation() {
    }

        function pointInPolygon($point, $polygon, $pointOnVertex = true) {
        $this->pointOnVertex = $pointOnVertex;

        // Transformar la cadena de coordenadas en matrices con valores "x" e "y"
        $point = $this->pointStringToCoordinates($point);
        $vertices = array();
        foreach ($polygon as $vertex) {
            $vertices[] = $this->pointStringToCoordinates($vertex);
        }

        // Checar si el punto se encuentra exactamente en un vértice
        if ($this->pointOnVertex == true and $this->pointOnVertex($point, $vertices) == true) {
            //return "En un Vertice";
			return "2";
        }

        // Checar si el punto está adentro del poligono o en el borde
        $intersections = 0;
        $vertices_count = count($vertices);

        for ($i=1; $i < $vertices_count; $i++) {
            $vertex1 = $vertices[$i-1];
            $vertex2 = $vertices[$i];
            if ($vertex1['y'] == $vertex2['y'] and $vertex1['y'] == $point['y'] and $point['x'] > min($vertex1['x'], $vertex2['x']) and $point['x'] < max($vertex1['x'], $vertex2['x'])) { // Checar si el punto está en un segmento horizontal
                //return "En el Borde";
				return "3";
            }
            if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) {
                $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x'];
                if ($xinters == $point['x']) { // Checar si el punto está en un segmento (otro que horizontal)
                    //return "En el Borde";
					return "3";
                }
                if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
                    $intersections++;
                }
            }
        }
        // Si el número de intersecciones es impar, el punto está dentro del poligono.
        if ($intersections % 2 != 0) {
            //return "Adentro";
			return "1";
        } else {
            //return "Afuera";
			return "0";
        }
    }

    function pointOnVertex($point, $vertices) {
        foreach($vertices as $vertex) {
            if ($point == $vertex) {
                return true;
            }
        }

    }

    function pointStringToCoordinates($pointString) {
        $coordinates = explode(" ", $pointString);
        return array("x" => $coordinates[0], "y" => $coordinates[1]);
    }

    // Matias 20180207
    function makePolygon($latLngPolygon){
      // Generar el poygono de la zona. Se debe pasar un array
      $polygon = array();
      foreach ($latLngPolygon as $key => $value) {
          $polygon[] = $value[0]." ".$value[1];
      }
      $polygon[] = $latLngPolygon[0][0]." ".$latLngPolygon[0][1]; // La ultima tiene que ser igual a la primera
      return $polygon;
    }

    function makePoints($latLngPoint){
      // Generar los puntos a buscar. Se debe pasar un array
      $pointSearched = array();
      foreach ($latLngPoint as $key => $value) {
          $pointSearched[] = $value[0]." ".$value[1];
      }
      return $pointSearched;
    }
    function mtsFromPolygon($latlng, $blockLatlngs) {
      // Si los angulos de un triangulo son menores a 90 grados hay un camino mas corto
      foreach ($polygon as $vertex) {
          $vertices[] = $this->pointStringToCoordinates($vertex);// Convierte en cordenadas x e y
      }
    }
    function haversineGreatCircleDistance($point1, $point2){
      $earthRadius = 6371000;// En metros, devuelve distancia en metros
      // convert from degrees to radians
      $latFrom = deg2rad($point1[0]);
      $lonFrom = deg2rad($point1[1]);
      $latTo = deg2rad($point2[0]);
      $lonTo = deg2rad($point2[1]);
      $latDelta = $latTo - $latFrom;
      $lonDelta = $lonTo - $lonFrom;
      $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
      return $angle * $earthRadius;
    }
    function shorterDistanceBeetweenAPointAndALine($point,$line){ // En metros
      // Line [[lat,lng],[lat,lng]] point [lat,lng]
      // Armo triangulo A y B la recta y C el punto, Si A y B menores a 90, El mas corto es : Sin(A)XB, sino la distancia a uno de los puntos.
      // Letras enfretadas a los angulos: cos(A) =  b2 + c2 − a2 / 2bc, cos(B) =  c2 + a2 − b2 / 2ca
      $C=$this->haversineGreatCircleDistance($line[0], $line[1]);
      $B=$this->haversineGreatCircleDistance($line[0], $point);
      $A=$this->haversineGreatCircleDistance($line[1], $point);
      $G=1.5708;// 90 grados son 1.57 radianes
      return (acos((pow($B, 2)+pow($C, 2)-pow($A,2))/(2*$B*$C))<$G && acos((pow($A, 2)+pow($C, 2)-pow($B,2))/(2*$A*$C))<$G)?sin(acos((pow($B, 2)+pow($C, 2)-pow($A,2))/(2*$B*$C)))*$B:min($B,$A);
    }

}
?>
