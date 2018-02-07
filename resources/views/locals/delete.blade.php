<h1>Entre al delete de locales</h1>
<form method="post" action="{{ route('locals.destroy',[$user->id]) }}" >
    {{csrf_field()}}
    <input type="hidden" name="_method" value="DELETE">
name : {{$usersBillingData->bussines_name}}<br>
email : {{$user->email}}<br>
phone : {{$user->phone}}<br>
==================================<br>
balance : {{$wallet->balance}}<br>
chips : {{$wallet->chips}}<br>
credit :{{$wallet->credit}}<br>


<input type="hidden" name="type" id="type" value="local">
<input type="hidden" name="user_id" id="type" value="{{$user->id}}">
<input type="submit" name="enviar" value="Enviar">
</form>
