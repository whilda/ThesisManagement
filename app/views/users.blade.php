@extends('layout')

@section('content')
    @for ($i = 0; $i < 10; $i++)
		The current value is {{ $i }} <br />
	@endfor
@stop
@section('user')
    @for ($i = 0; $i < 10; $i++)
		The current value is {{ $i }} <br />
	@endfor
@stop