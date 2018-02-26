<h1>Entre al Control de infringements</h1>
@foreach($infringements as $infringement)
  {{$infringement->plate}} {{$infringement->date}} {{$infringement->block_id}} {{$infringement->created_at}}<br> 
@endforeach
