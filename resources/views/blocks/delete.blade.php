<h1>Entre al delete de Blocks</h1>
<form method="post" action="{{ route('blocks.destroy',[$findBlock->id]) }}" >
    {{csrf_field()}}
    <input type="hidden" name="_method" value="DELETE">
street  : {{$findBlock->street}}<br>
Nro. Min :{{$findBlock->numeration_min}} <br>
Nro. Max : {{$findBlock->numeration_max}} <br>
spaces :  {$findBlock->spaces}} <br>
latLng : {{$findBlock->latlng}} <br>
 <br>
<input type="submit" name="enviar" value="Enviar">
</form>
