<h1>Entre al create de infringementcauses</h1>
<br><br>
<form method="post" action="{{ route('infringementcauses.store') }}" >
    {{csrf_field()}}
name <input type="text" name="name" id="name" value=""><br>
details <textarea name="details" id="details" rows="8" cols="80"></textarea> <br>
cost <input type="text" name="cost" id="cost" value=""><br>
name <input type="text" name="voluntary_cost" id="voluntary_cost" value=""><br>
<input type="submit" name="enviar" value="Enviar">
</form>
