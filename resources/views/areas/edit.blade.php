<h1>Entre en edit areas</h1>
{{currentUser()->name}}
<br><br>
<form method="post" action="{{ route('areas.update',[$area->id]) }}" >
    {{csrf_field()}}
    <input type="hidden" name="_method" value="PUT">

name <input type="text" name="name" id="name" value="{{$area->name}}"><br>
details <textarea name="details" id="details" rows="8" cols="80">{{$area->details}}</textarea> <br>
latlng <textarea name="latlng" id="latlng" rows="8" cols="80">{{$area->latlng}}</textarea> <br>
<input type="submit" name="enviar" value="Enviar">
</form>
