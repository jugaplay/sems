<h1>Entre a la venta de credito de locales</h1>
{{currentUser()->name}}
<br><br>
<form method="post" action="{{ route('tickets.localcredit.save') }}" >
    {{csrf_field()}}
Nombre
<select name="user_id">
  <option value="0">Seleccione una Usuario</option>
    @foreach($drivers as $driver)
      <option value="{{ $driver->id }}" >{{ $driver->name }}</option>
    @endforeach
</select><br>
Importe <input type="text" name="amount" id="amount "value=""><br>
<br><br>
<input type="submit" name="enviar" value="Enviar">
