<h1>create de SpaceReservations</h1>
<form method="post" action="{{ route('spacereservations.store') }}" >
    {{csrf_field()}}
identifier <input type="text" name="identifier" id="identifier" value=""><br>
company <input type="text" name="company" id="company" value=""><br>
latlng <textarea name="latlng" id="llatlngatitude"cols="8" value=""></textarea><br>
start_time <input type="text" name="start_time" id="start_time" value=""><br>
end_time <input type="text" name="end_time" id="end_time" value=""><br>
Block <select name="block">
  <option value="0">Seleccione una calle</option>
  @foreach($blocks as $block)
    <option value="{{ $block->id }}">{{ $block->street }}</option>
  @endforeach
</select><br>
Type <select name="type">
      <option value="container">container</option>
      <option value="load_unload">load unload</option>
</select><br>
size (numero)<input type="text" name="size" id="size" value=""><br>
amount <input type="text" name="amount" id="amount" value=""><br>
<input type="submit" name="enviar" value="Enviar">
</form>
