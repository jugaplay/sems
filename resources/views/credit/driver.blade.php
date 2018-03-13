<h1>Entre a la venta de Ticket de drivers</h1>
{{currentUser()->name}}
<br><br>
<form method="post" action="{{ route('tickets.driverticket.save') }}" >
    {{csrf_field()}}
Patente <input type="text" name="plate" id="plate "value=""><br>
type
<select name="type">
      <option value="time">Hora</option>
      <option value="day">Estadía</option>
</select><br>
Horas <input type="text" name="time" id="time "value=""><br>
LatLng <input type="text" name="latlng" id="latlng "value=""><br>

<br><br>
<input type="submit" name="enviar" value="Enviar">
