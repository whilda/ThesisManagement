@extends('student/layout')

@section('pageTitle')
	Profile
@stop

@section('profile.nav') selected="selected" @stop
@section('profile.menu') active @stop

@section('content')

<div id="blog-posts">

    <div class="row-fluid">
      <div class="span12">
        <center><h4 style="font-size:25px"><strong>{{ $data['name'] }}</strong></h4></center><br/>
        <div class="row-fluid">
			<div class="offset2 span2 thumbnail">
                <img src="{{ URL::to('/') }}/images/blog/442256_20337880.jpg" alt="">
			</div>
			<div class="span5">
			<ul class="item-summary">
				<li class="clearfix">
				  <!-- Text input-->
				  <div class="span4">Username :</div>
				  <div class="span8">
					{{ $data['_id'] }}
				  </div>
				</li>
				<li class="clearfix">
				  <!-- Text input-->
				  <div class="span4">NIM :</div>
				  <div class="span8">
					{{ $data['nim'] }}
				  </div>
				</li>
				<li class="clearfix">
				  <!-- Text input-->
				  <div class="span4">Alamat :</div>
				  <div class="span8">
					{{ nl2br($data['address']) }}
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
				  <div class="span4">Supervisor :</div>
				  <div class="span8">
					{{ $data['supervisor']?$data['supervisor']:"-" }}
				  </div>
				</li>
				<li class="clearfix">
				<a class="btn btn-mini" href="{{ URL::to('/') }}/student/profile/edit">Edit</a>
				</li>
			</ul>
			</div>
        </div>
      </div>
    </div>
    
</div>
@stop