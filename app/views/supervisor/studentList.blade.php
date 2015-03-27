@extends('supervisor/layout')

@section('pageTitle')
	Student List
@stop

@section('student.nav') selected="selected" @stop
@section('student.menu') active @stop

@section('content')
    <h2>Student List</h2>

<div id="blog-posts">
	@if(count($data)!=0)
	@foreach($data as $student)
    <div class="row-fluid blog-post">
      <div class="span12">
        <h4><strong><a href="{{ URL::to('/') }}/student/{{ $student['_id'] }}">{{ $student['name'] }}</a></strong></h4>
        <div class="row-fluid">
            <a href="#" class="thumbnail pull-left">
                <img src="{{ URL::to('/') }}/images/blog/442256_20337880.jpg" alt="">
            </a>
            <div class="post-summary">      
                <p>
                  NIM: {{ $student['nim'] }}<br/>
                </p>
                <p><a class="btn btn-mini" href="{{ URL::to('/') }}/student/{{ $student['_id'] }}">Lihat Detail</a></p>
            </div>
        </div>
        <div class="row-fluid details">
            <i class="icon-tags"></i> Field 
			@if(count($student['thesis']['field'])!=0)
			@foreach($student['thesis']['field'] as $field)
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
		Tidak ada student yang terdaftar.
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