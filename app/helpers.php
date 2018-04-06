<?php
function currentUser()
{
    return auth()->user();
}
function parseDateString($date){
  // De esto: 2018-03-15 a esto : 15/03/2018
  return substr($date, 8, 2)."/".substr($date, 5, 2)."/".substr($date, 0, 4);
}
function parseDateTimeString($date){
  // De esto: 2018-03-15 15:03:20 a esto : 15:03 Hs, 15/03/2018
  return substr($date, 11, 2).":".substr($date, 14, 2)." Hs,".substr($date, 8, 2)."/".substr($date, 5, 2)."/".substr($date, 0, 4);
}
function imgOfTypeOfUser($type){
  switch ($type) {
    case 'admsuper':
        return "images/dummy/uifaces13.jpg";
      break;
    case 'adm':
        return "images/dummy/uifaces15.jpg";
      break;
    case 'city':
        return "images/dummy/uifaces15.jpg";
      break;
    case 'judge':
        return "images/dummy/uifaces16.jpg";
      break;
    case 'driver':
        return "images/dummy/uifaces19.jpg";
      break;
    case 'local':
        return "images/dummy/uifaces14.jpg";
      break;
    case 'inspector':
        return "images/dummy/uifaces18.jpg";
      break;
    case 'assistant':
        return "images/dummy/uifaces17.jpg";
      break;
    default:
        return "images/dummy/unknown-profile.jpg";
      break;
  }
}
function parseAccountStatus($status){
  switch ($status) {
    case "C":
      return "Confirmada";
      break;
    case "N":
      return "No confirmada";
      break;
    case "B":
      return "Baja";
      break;
    default:
      return "Otro";
      break;
  }
}
function parseInverseAccountStatus($status){
  switch ($status) {
    case "Confirmada":
      return "C";
      break;
    case 'No confirmada':
      return "N";
      break;
    case 'Baja':
      return "B";
      break;
    default:
      return "O";
      break;
  }
}
function parseAccountType($type){
  switch ($type) {
    case "inspector":
      return "Inspector";
      break;
    case "judge":
      return "Juez";
      break;
    case "admin":
      return "Administrador";
      break;
    case "admsuper":
      return "Super admin";
      break;
    case "city":
      return "Municipalidad";
      break;
    case "driver":
      return "Conductor";
      break;
    case "local":
      return "Local";
    case "assistant":
      return "Asistente";
      break;
    default:
      return "Otro";
      break;
  }
}
function parseInverseAccountType($type){
  switch ($type) {
    case "Inspector":
      return "inspector";
      break;
    case "Local":
      return "local";
      break;
    case "Juez":
      return "judge";
      break;
    case "Administrador":
      return "admin";
      break;
    case "Super admin":
      return "admsuper";
      break;// Asistente
    case "Municipalidad":
      return "city";
      break;
    case "Asistente":
      return "assistant";
      break;
    case "Conductor":
      return "driver";
      break;
    default:
      return "other";
      break;
  }
}
function parseOperationalType($type, $amount=null){
  switch ($type) {
    case "App\ExeptuatedVehicle":
      return "Vehículo exceptuado";
      break;
    case "App\Ticket":
      return "Ticket";
      break;
    case "App\Wallet":
      if($amount!=null){
        return ($amount>0)?"Recarga":"Compra";
      }else{
        return "Billetera";
      }
      break;
    case "App\SpaceReservation":
      return "Espacio reservado";
      break;
    case "App\ExeptuatedVehicleBlock":
      return "Vehículo exceptuado";
      break;// Asistente
    case "App\Infringement":
      return "Infracción";
      break;
    default:
      return "otro";
      break;
  }
}
function parseTicketType($type){
  switch ($type) {
    case "time":
      return "Tiempo";
      break;
    case "day":
      return "Estadía";
      break;
      return "otro";
      break;
  }
}
/*
Descripción: El algoritmo del punto en un polígono permite comprobar mediante
programación si un punto está dentro de un polígono o fuera de ello.
Autor: Michaël Niessen (2009)
Sito web: AssemblySys.com
*/

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

}

?>
