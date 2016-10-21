@extends('student/layout')

@section('pageTitle')
	Nama Supervisor
@stop

@section('super.nav') selected="selected" @stop
@section('super.menu') active @stop

@section('content')

<div id="blog-posts">

    <div class="row-fluid">
      <div class="span12">
        <center><h4 style="font-size:25px"><strong>{{ $data['name'] }}</strong></h4></center><br/>
        <div class="row-fluid">
			<div class="offset2 span2 thumbnail">
                <img src="http://www.gravatar.com/avatar/{{ md5($data['email']) }}" alt="">
			</div>
			<div class="span5">
			<ul class="item-summary">
				<li class="clearfix">
				  <!-- Text input-->
				  <div class="span4">NPP :</div>
				  <div class="span8">
					{{ $data['npp'] }}
				  </div>
				</li>
				<li class="clearfix">
				  <!-- Text input-->
				  <div class="span4">Alamat :</div>
				  <div class="span8">
					{{ $data['address'] }}
				  </div>
				</li>
				<li class="clearfix">
				  <!-- Text input-->
				  <div class="span4">No. HP :</div>
				  <div class="span8">
					{{ $data['handphone'] }}
				  </div>
				</li>
				<li class="clearfix">
				  <!-- Text input-->
				  <div class="span4">Email :</div>
				  <div class="span8">
					{{ $data['email'] }}
				  </div>
				</li>
				<li class="clearfix">
				  <!-- Text input-->
				  <div class="span4">Mahasiswa :</div>
				  <div class="span8">
					{{ count($data['student']) }}
				  </div>
				</li>
				<li class="clearfix">
				  <!-- Text input-->
				  <div class="span4">Expertise :</div>
				  <div class="span8">
					@foreach($data['field'] as $field)
					<a href="#"><span class="label label-info">{{ $field }}</span></a> 
					@endforeach
				  </div>
				</li>
				<li class="clearfix">
				@if($status==-1)
				<a class="btn btn-mini" href="{{ URL::to('/') }}/student/supervisor/select/{{ $data['_id'] }}">Pilih Supervisor</a>
				@endif
				<button class="btn btn-mini" onclick="window.history.go(-1)">Kembali</button>
				</li>
			</ul>
			</div>
        </div>
      </div>
    </div>
    
</div>
@stop