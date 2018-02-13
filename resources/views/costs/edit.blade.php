<h1>Entre al Edite de costs</h1>
<br><br>
<form method="post" action="{{ route('costs.update',[$cost->id]) }}" >
    {{csrf_field()}}
    <input type="hidden" name="_method" value="PUT">
Seleccione un area
<select name="area_id">
  <option value="0">Seleccione una Area</option>
    @foreach($areas as $area)
      <option value="{{ $area->id }}" @if($cost->area_id == $area->id) selected @endif>{{ $area->name }}</option>
    @endforeach
</select><br>
time_zone_start <input type="text" name="time_zone_start" id="time_zone_start" value="{{$cost->time_zone_start}}"><br>
time_zone_end <input type="text" name="time_zone_end" id="time_zone_end" value="{{$cost->time_zone_end}}"><br>
start_date <input type="text" name="start_date" id="start_date" value="{{$cost->start_date}}"><br>
end_date <input type="text" name="end_date" id="end_date" value="{{$cost->end_date}}"><br>
priority <input type="text" name="priority" id="priority" value="{{$cost->priority}}"><br>
type
<select name="type">
      <option value="hora"  @if($cost->type == 'hora') selected @endif>Hora</option>
      <option value="estadia"  @if($cost->type == 'estadia') selected @endif>Estadía</option>
</select><br>
cost <input type="text" name="cost" id="cost" value="{{$cost->cost}}"><br>

day_start (1-Domingo 7-Sabado)<input type="text" name="day_start" id="day_starts" value="{{$cost->day_start}}"><br>
day_end (1-Domingo 7-Sabado)<input type="text" name="day_end" id="day_end" value="{{$cost->day_end}}"><br>
<br><br>
<input type="submit" name="enviar" value="Enviar">
</form>
