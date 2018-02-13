<h1>Entre al Create de costs</h1>
<br><br>
<form method="post" action="{{ route('costs.store') }}" >
    {{csrf_field()}}
Seleccione un area
<select name="area_id">
  <option value="0">Seleccione una Area</option>
    @foreach($areas as $area)
      <option value="{{ $area->id }}" >{{ $area->name }}</option>
    @endforeach
</select><br>
time_zone_start <input type="text" name="time_zone_start" id="time_zone_start" value="08:00"><br>
time_zone_end <input type="text" name="time_zone_end" id="time_zone_end" value="20:00"><br>
start_date <input type="text" name="start_date" id="start_date" value=""><br>
end_date <input type="text" name="end_date" id="end_date" value="2099-12-31"><br>
priority <input type="text" name="priority" id="priority" value="1"><br>
type
<select name="type">
      <option value="hora" >Hora</option>
      <option value="estadia" >Estadía</option>
</select><br>
cost <input type="text" name="cost" id="cost" value=""><br>

day_start (1-Domingo 7-Sabado)<input type="text" name="day_start" id="day_starts" value="1"><br>
day_end (1-Domingo 7-Sabado)<input type="text" name="day_end" id="day_end" value="7"><br>
<br><br>
<input type="submit" name="enviar" value="Enviar">
</form>
