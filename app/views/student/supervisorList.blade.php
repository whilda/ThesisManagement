@extends('student/layout')

@section('pageTitle')
	Supervisor List
@stop

@section('super.nav') selected="selected" @stop
@section('super.menu') active @stop

@section('content')
    <h2>Supervisor List</h2>

<div id="blog-posts">
	@if(count($data)!=0)
	@foreach($data as $supervisor)
    <div class="row-fluid blog-post">
      <div class="span12">
        <h4><strong><a href="{{ URL::to('/') }}/student/supervisor/{{ $supervisor['_id'] }}">{{ $supervisor['name'] }}</a></strong></h4>
        <div class="row-fluid">
            <a href="{{ URL::to('/') }}/student/supervisor/{{ $supervisor['_id'] }}" class="thumbnail pull-left">
                <img src="http://www.gravatar.com/avatar/{{ md5($supervisor['email']) }}" alt="">
            </a>
            <div class="post-summary">      
                <p>
                  Email: {{ $supervisor['email'] }}<br/>
                </p>
                <p><a class="btn btn-mini" href="{{ URL::to('/') }}/student/supervisor/{{ $supervisor['_id'] }}">Lihat Detail</a> <a class="btn btn-mini" href="{{ URL::to('/') }}/student/supervisor/{{ $supervisor['_id'] }}/select">Pilih Supervisor</a></p>
            </div>
        </div>
        <div class="row-fluid details">
            <i class="icon-user"></i> Mahasiswa: {{ count($supervisor['student']) }} orang 
            | <i class="icon-tags"></i> Expertise 
			@if(count($supervisor['field'])!=0)
			@foreach($supervisor['field'] as $field)
			<a href="#"><span class="label label-info">{{ $field }}</span></a> 
			@endforeach
			@else
			-
			@endif
        </div>
      </div>
    </div>
	@endforeach
	@else
		Tidak ada supervisor yang terdaftar.
	@endif

    
    
</div>
@stop