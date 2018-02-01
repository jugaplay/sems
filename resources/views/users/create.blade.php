<h1>Alta de Usuarios</h1>
<form method="post" action="{{ route('users.store') }}" >
    {{csrf_field()}}
name <input type="text" name="name" id="name "value=""><br>
email <input type="text" name="email" id="email "value=""><br>
phone <input type="text" name="phone" id="phone "value=""><br>
password <input type="password" name="password" id="password "value=""><br>
type <select name="type" id="type" class="form-control" id="proyects-user"><br>
    <option value="local">local</option>
    <option value="driver">driver</option>
    <option value="inspector">inspector</option>
    <option value="assistant">assistant</option>
    <option value="judge">judge</option>
    <option value="admin">admin</option>
    <option value="city">city hall</option>
</select><br>
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
-->
