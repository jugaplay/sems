<h1>Entre a desasociar Vehiculos de Usuarios</h1>
<form class="" method="post" action="{{ route('user.vehiclesOff.save') }}">
  {{csrf_field()}}
  Patentes asociadas
 <select name="plate_id">
    <option value="0">Seleccione unaPatente</option>
    @foreach($findVehicles as $vehicle)
      <option value="{{ $vehicle->id }}" >{{ $vehicle->plate }}</option>
    @endforeach
  </select><br>
<br><br>
<input type="submit" name="enviar" value="Enviar">
</form>
