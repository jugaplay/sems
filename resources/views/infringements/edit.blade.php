<h1>Entre al edite de infringements</h1>
<br><br>
<br><br>
<form method="post" action="{{ route('infringements.update',[$infringement->id]) }}" >
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PUT">
<select name="infragmentCausesId">
      <option value="0">Seleccione una causa</option>
        @foreach($infragmentCauses as $infragmentCause)
          <option value="{{ $infragmentCause->id }}" @if($infragmentCause->id == $infringement->infringement_cause_id) selected @endif>{{ $infragmentCause->name }}</option>
        @endforeach
    </select><br>
date <input type="text" name="date" id="date" value="{{$infringement->date}}"><br>
voluntary_end_date <input type="text" name="voluntary_end_date" id="voluntary_end_date" value="{{$infringement->date}}"><br>
plate <input type="text" name="plate" id="plate" value="{{$infringement->date}}"><br>
detail <textarea name="detail" id="detail" rows="8" cols="80">{{$infringement->details()->first()->detail}}</textarea> <br>
latlng <input type="text" name="latlng" id="latlng" value="{{$infringement->latlng}}"><br>
<input type="hidden" name="infringementDetailId" value="{{$infringement->details()->first()->id}}">
<input type="submit" name="enviar" value="Enviar">
</form>
