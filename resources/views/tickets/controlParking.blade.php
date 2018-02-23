<h1>Entre al control parking de tickets</h1>
<br><br>
<form method="post" action="{{ route('tickets.controlparking.save') }}" >
    {{csrf_field()}}
Patente <input type="text" name="plate" id="plate "value=""><br>
latLng <input type="text" name="latlng" id="latlng "value=""><br>
<br><br>
<input type="submit" name="enviar" value="Enviar">
