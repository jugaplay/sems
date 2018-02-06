<h1>Alta de Locales</h1>
<form method="post" action="{{ route('locals.store') }}" >
    {{csrf_field()}}
name <input type="text" name="bussines_name" id="bussines_name "value=""><br>
email <input type="text" name="email" id="email "value=""><br>
phone <input type="text" name="phone" id="phone "value=""><br>
I.V.A.  <select name="tax_treatment" id="tax_treatment" class="form-control" id="proyects-user"><br>
        <option value="0">Responsable Inscripto</option>
        <option value="1">Monottributo</option>
</select><br>
address <input type="text" name="address" id="address "value=""><br>
address <input type="text" name="address_billing" id="address_billing "value=""><br>
city <input type="text" name="city" id="city "value=""><br>
state <input type="text" name="state" id="state "value=""><br>
Tipo de Documento  <select name="document_type" id="document_type" class="form-control" id="proyects-user"><br>
        <option value="80">C.U.I.T</option>
        <option value="86">C.U.I.L.</option>
        <option value="96">D.N.I.</option>
</select><br>
Nro Doc. <input type="text" name="document_number" id="document_number "value=""><br>
fee <input type="text" name="fee" id="fee "value=""><br>

latlng <input type="text" name="latlng" id="latlng "value=""><br>
password <input type="password" name="password" id="password "value=""><br>

<input type="hidden" name="type" id="type" value="local">
<input type="hidden" name="account_status" id="account_status" value="N">
<input type="submit" name="enviar" value="Enviar">
</form>
 <!--
 'name',
 'email',
 'password',
 'phone',
 'type' (local/driver/inspector/assistant/judge/admin/super user/city hall),
 'account_status',

bussines_name
tax_treatment
address
city
state
document_type
document_number
-->
