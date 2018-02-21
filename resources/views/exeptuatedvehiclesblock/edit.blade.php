<h1>Entro al edit de vehiculos exceptuados block</h1>
<form class="" method="post" action="{{ route('exeptuatedvehicles.update',[$exeptuatedvehicle->id]) }}">
  {{csrf_field()}}
  <input type="hidden" name="_method" value="PUT">
Patente <input type="text" name="plate"  id="plate" value="{{$exeptuatedvehicle->vehicle->plate}}"><br>
Causa
<select name="exeptuated_cause_id">
  @foreach($causes as $cause)
    <option value="{{ $cause->id }}">{{ $cause->name }}</option>
  @endforeach
</select><br>
Desde <input type="text" name="start_time"  id="start_time" value="{{$exeptuatedvehicle->start_time}}"><br>
Hasta <input type="text" name="end_time"  id="end_time" value="{{$exeptuatedvehicle->end_time}}"><br>
details <textarea name="detail" id="details" rows="8" cols="80">{{$exeptuatedvehicle->detail}}</textarea> <br>
latlng <textarea name="latlng" id="latlng" rows="8" cols="80"></textarea> <br>
amount : {{$exeptuatedvehicle->operation->amount}} <br>
  <input type="submit" name="enviar" value="Enviar">
</form>
