<h1>Entre al cancel de infringements</h1>
<br>
<form method="post" action="{{ route('infringements.cancel.save',[$infringement->id]) }}" >
            {{csrf_field()}}
<br>
Causa de Infraccion : {{$infringement->cause()->first()->name}}<br>

date : {{$infringement->date}}<br>
voluntary_end_date : {{$infringement->voluntary_end_date}}<br>
plate {{$infringement->plate}}<br>
Direccion : {{$infringement->block()->first()->street}}<br>
cost : {{$infringement->cost}}<br>
voluntary_cost : {{$infringement->voluntary_cost}}<br>
payment made : <input type="text" name="payment" value=""><br>
situation
<select name="situation">
      <option value="before" @if($infringement->situation == 'before') selected @endif>before</option>
      <option value="saved" @if($infringement->situation == 'saved') selected @endif>saved</option>
      <option value="voluntary" @if($infringement->situation == 'voluntary') selected @endif>voluntary</option>
      <option value="judge" @if($infringement->situation == 'judge') selected @endif>judge</option>
      <option value="close" @if($infringement->situation == 'close') selected @endif>close</option>
</select><br>
<textarea name="detail" id="detail" rows="8" cols="80"></textarea> <br>
<input type="hidden" name="infringementId" value="{{$infringement->id}}">
<input type="submit" name="enviar" value="Enviar">
</form>
