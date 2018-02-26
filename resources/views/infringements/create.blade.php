<h1>Entre al create de infringements</h1>
<br><br>
<form method="post" action="{{ route('infringements.store') }}" >
    {{csrf_field()}}
<select name="infragmentCausesId">
      <option value="0">Seleccione una causa</option>
        @foreach($infragmentCauses as $infragmentCause)
          <option value="{{ $infragmentCause->id }}" >{{ $infragmentCause->name }}</option>
        @endforeach
    </select><br>
date <input type="text" name="date" id="date" value=""><br>
voluntary_end_date <input type="text" name="voluntary_end_date" id="voluntary_end_date" value=""><br>
plate <input type="text" name="plate" id="plate" value=""><br>
situation <textarea name="situation" id="situation" rows="8" cols="80"></textarea> <br>
latlng <input type="text" name="latlng" id="latlng" value=""><br>
<input type="submit" name="enviar" value="Enviar">
</form>
