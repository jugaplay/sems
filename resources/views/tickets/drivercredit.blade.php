<h1>Entre a la venta de credito de driver</h1>
{{currentUser()->name}}
<br><br>
<form method="post" action="{{ route('tickets.drivercredit.save') }}" >
    {{csrf_field()}}
Importe <input type="text" name="amount" id="amount "value=""><br>
<br><br>
<input type="submit" name="enviar" value="Enviar">
