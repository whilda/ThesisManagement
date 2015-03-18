@extends('student/layout')

@section('pageTitle')
	Supervisor List
@stop

@section('super.nav') selected="selected" @stop
@section('super.menu') active @stop

@section('content')
    <h2>Supervisor List</h2>
	@if($status==-2)
	<div class="alert">Anda belum mengisi thesis. Klik link berikut untuk mengisi <a href="{{ URL::to('/student/thesis') }}">thesis</a></div>
	@endif

<div id="blog-posts">
	@if(count($data)!=0)
	@foreach($data as $supervisor)
    <div class="row-fluid blog-post">
      <div class="span12">
        <h4><strong><a href="{{ URL::to('/') }}/student/supervisor/{{ $supervisor['_id'] }}">{{ $supervisor['name'] }}</a></strong></h4>
        <div class="row-fluid">
            <a href="{{ URL::to('/') }}/student/supervisor/{{ $supervisor['_id'] }}" class="thumbnail pull-left" style="min-height:30px">
                <img src="http://www.gravatar.com/avatar/{{ md5($supervisor['email']) }}" alt="">
            </a>
            <div class="post-summary">      
                <p>
                  Email: {{ $supervisor['email'] }}<br/>
                </p>
                <p><a class="btn btn-mini" href="{{ URL::to('/') }}/student/supervisor/{{ $supervisor['_id'] }}">Lihat Detail</a> 
				@if($status==-1)
				<a class="btn btn-mini" href="{{ URL::to('/') }}/student/supervisor/select/{{ $supervisor['_id'] }}">Pilih Supervisor</a>
				@endif
				</p>
            </div>
        </div>
        <div class="row-fluid details">
            <i class="icon-user"></i> Mahasiswa: {{ count($supervisor['student']) }} orang 
            | <i class="icon-tags"></i> Expertise 
			@if(count($supervisor['field'])!=0)
			@foreach($supervisor['field'] as $field)
			<a href="{{ URL::to('/') }}/student/supervisorList/field/{{ $field }}"><span class="label label-info">{{ $field }}</span></a> 
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
	@if(isset($pagination))
	<div class="fancy pagination">
	<center>
	  <ul>
		{{ $pagination }}
	  </ul>
	</center>
	</div>
	@endif
@stop