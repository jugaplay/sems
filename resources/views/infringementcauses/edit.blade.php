<h1>Entre al edit de infringementcauses</h1>
<form method="post" action="{{ route('infringementcauses.update',[$infringementcauses->id]) }}" >
    {{csrf_field()}}
    <input type="hidden" name="_method" value="PUT">
name <input type="text" name="name" id="name" value="{{$infringementcauses->name}}"><br>
details <textarea name="detail" id="detail" rows="8" cols="80">{{$infringementcauses->detail}}</textarea> <br>
cost <input type="text" name="cost" id="cost" value="{{$infringementcauses->cost}}"><br>
voluntary_cost <input type="text" name="voluntary_cost" id="voluntary_cost" value="{{$infringementcauses->voluntary_cost}}"><br>

<input type="hidden" name="infringementcausesId" id="type" value="{{$infringementcauses->id}}">
<input type="submit" name="enviar" value="Enviar">
</form>
