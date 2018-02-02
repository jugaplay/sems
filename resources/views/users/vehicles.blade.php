<h1>Entre al Alta de Vehiculos de Usuarios</h1>
<form class="" method="post" action="{{ route('user.vehicles.save') }}">
  {{csrf_field()}}
Patente <input type="text" name="plate" value=""><br>
<input type="submit" name="enviar" value="Enviar">
</form>
