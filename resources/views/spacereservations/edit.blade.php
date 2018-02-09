<h1>Edit de SpaceReservations</h1>
<form method="post" action="{{ route('spacereservations.update',[$spacereservation->id]) }}" >
    {{csrf_field()}}
    <input type="hidden" name="_method" value="PUT">
identifier <input type="text" name="identifier" id="identifier" value="{{$spacereservation->identifier}}"><br>
company <input type="text" name="company" id="company" value="{{$spacereservation->company}}"><br>
latlng <textarea name="latlng" id="latlng" cols="80" value="">{{$spacereservation->latlng}}</textarea><br>
start_time <input type="text" name="start_time" id="start_time" value="{{$spacereservation->start_time}}"><br>
end_time <input type="text" name="end_time" id="end_time" value="{{$spacereservation->end_time}}"><br>
Block <select name="block">
  <option value="0">Seleccione una calle</option>
  @foreach($blocks as $block)
    <option value="{{ $block->id }}" @if($spacereservation->block_id == $block->id ) selected @endif >{{ $block->street }}</option>
  @endforeach
</select><br>
Type <select name="type">
      <option value="container" @if($spacereservation->type == "container" ) selected @endif >container</option>
      <option value="load_unload" @if($spacereservation->type == "load_unload" ) selected @endif >load unload</option>
</select><br>
size (numero)<input type="text" name="size" id="size" value="{{$spacereservation->size}}"><br>
amount {{$spacereservation->amount}}<br>
<input type="submit" name="enviar" value="Enviar">
</form>
