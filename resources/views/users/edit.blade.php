<h1>Editar de Usuarios</h1>
<form method="post" action="{{ route('users.update',[$user->id]) }}" >
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PUT">
name <input type="text" name="name" id="name" value="{{$user->name}}"><br>
email <input type="text" name="email" id="email "value="{{$user->email}}"><br>
phone <input type="text" name="phone" id="phone "value="{{$user->phone}}"><br>
password <input type="password" name="password" id="password "value=""><br>

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
