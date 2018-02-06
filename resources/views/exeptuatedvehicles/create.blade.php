<h1>Entro al create de vehiculos exceptuados</h1>
<form class="" method="post" action="{{ route('exeptuatedvehicles.store') }}">
  {{csrf_field()}}

Patente <input type="text" name="plate"  id="plate" value=""><br>
Causa
<select name="exeptuated_cause_id">
  @foreach($causes as $cause)
    <option value="{{ $cause->id }}">{{ $cause->name }}</option>
  @endforeach
</select><br>

Desde <input type="text" name="start_time"  id="start_time" value=""><br>
Hasta <input type="text" name="end_time"  id="end_time" value=""><br>
details <textarea name="detail" id="details" rows="8" cols="80"></textarea> <br>
latlng <textarea name="latlng" id="latlng" rows="8" cols="80"></textarea> <br>
amount <input type="text" name="amount"  id="amount" value=""><br>
  <input type="submit" name="enviar" value="Enviar">
</form>
