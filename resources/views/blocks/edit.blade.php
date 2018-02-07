<h1>Entro al edit de blocks</h1>
<form method="post" action="{{ route('blocks.update',[$block->id]) }}" >
    {{csrf_field()}}
    <input type="hidden" name="_method" value="PUT">
street <input type="text" name="street" id="street "value="{{$block->street}}"><br>
Nro. Min <input type="text" name="numeration_min" id="numeration_min "value="{{$block->numeration_min}}"><br>
Nro. Max <input type="text" name="numeration_max" id="numeration_max "value="{{$block->numeration_max}}"><br>
spaces <input type="text" name="spaces" id="spaces "value={{$block->spaces}}><br>
latLng <textarea name="latlng" id="latlng "value="" cols="80">{{$block->latlng}}</textarea><br>

<input type="hidden" name="account_status" id="account_status" value="N">
<input type="submit" name="enviar" value="Enviar">
</form>
