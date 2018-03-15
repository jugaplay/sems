@switch(Auth::user()->type)
    @case("inspector")
        @include('infringements.inspector')
        @break
    @default
        @include('error.index')
@endswitch
