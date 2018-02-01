<h1>Alta de Cuadras</h1>
<form method="post" action="{{ route('blocks.store') }}" >
    {{csrf_field()}}
street <input type="text" name="street" id="street "value=""><br>
Nro. Min <input type="text" name="numeration_min" id="numeration_min "value=""><br>
Nro. Max <input type="text" name="numeration_max" id="numeration_max "value=""><br>
Coordenadas <input type="text" name="Coordenadas" id="Coordenadas "value=""><br>

<input type="hidden" name="account_status" id="account_status" value="N">
<input type="submit" name="enviar" value="Enviar">
</form>
