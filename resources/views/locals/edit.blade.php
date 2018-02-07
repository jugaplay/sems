<h1>Entre al edit de locales</h1>
<form method="post" action="{{ route('locals.update',[$user->id]) }}" >
    {{csrf_field()}}
    <input type="hidden" name="_method" value="PUT">
name <input type="text" name="bussines_name" id="bussines_name "value="{{$usersBillingData->bussines_name}}"><br>
email <input type="text" name="email" id="email "value="{{$user->email}}"><br>
phone <input type="text" name="phone" id="phone "value="{{$user->phone}}"><br>
I.V.A.  <select name="tax_treatment" id="tax_treatment" class="form-control" id="proyects-user"><br>
        <option value="0" @if($usersBillingData->tax_treatment == '0') selected @endif>Responsable Inscripto</option>
        <option value="1" @if($usersBillingData->tax_treatment == '1') selected @endif>Monottributo</option>
</select><br>
address <input type="text" name="address" id="address "value="{{$local->address}}"><br>
address <input type="text" name="address_billing" id="address_billing "value="{{$usersBillingData->address}}"><br>
city <input type="text" name="city" id="city "value="{{$usersBillingData->city}}"><br>
state <input type="text" name="state" id="state "value="{{$usersBillingData->state}}"><br>
Tipo de Documento  <select name="document_type" id="document_type" class="form-control" id="proyects-user"><br>
        <option value="80" @if($usersBillingData->document_type == '80') selected @endif>C.U.I.T</option>
        <option value="86" @if($usersBillingData->document_type == '86') selected @endif>C.U.I.L.</option>
        <option value="96" @if($usersBillingData->document_type == '96') selected @endif>D.N.I.</option>
</select><br>
Nro Doc. <input type="text" name="document_number" id="document_number "value="{{$usersBillingData->document_number}}"><br>
fee <input type="text" name="fee" id="fee "value="{{$local->fee}}"><br>

latlng <input type="text" name="latlng" id="latlng "value="{{$local->latlng}}"><br>
password <input type="password" name="password" id="password "value=""><br>

balance : {{$wallet->balance}}<br>
chips : {{$wallet->chips}}<br>
credit :{{$wallet->credit}}<br>

<input type="hidden" name="type" id="type" value="local">
<input type="hidden" name="user_id" id="type" value="{{$user->id}}">
<input type="submit" name="enviar" value="Enviar">
</form>
