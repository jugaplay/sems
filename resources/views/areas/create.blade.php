<h1>Entre en create areas</h1>
<form method="post" action="{{ route('areas.store') }}" >
    {{csrf_field()}}
name <input type="text" name="name" id="name" value=""><br>
details <textarea name="details" id="details" rows="8" cols="80"></textarea> <br>
<input type="submit" name="enviar" value="Enviar">
</form>
