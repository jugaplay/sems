@switch(Auth::user()->type)
    @case("driver")
        @include('vouchers.driver')
        @break
    @default
        @include('error.index')
@endswitch
