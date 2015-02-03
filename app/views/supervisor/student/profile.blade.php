@extends('supervisor/student/layout')

@section('pageTitle')
	Nama Student
@stop

@section('profile.nav') selected="selected" @stop
@section('profile.menu') active @stop

@section('content')

<div id="blog-posts">

    <div class="row-fluid">
      <div class="span12">
        <center><h4 style="font-size:25px"><strong>Nama Student</strong></h4></center><br/>
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
					asdf
				  </div>
				</li>
				<li class="clearfix">
				  <!-- Text input-->
				  <div class="span4">NIM :</div>
				  <div class="span8">
					12312312312
				  </div>
				</li>
				<li class="clearfix">
				  <!-- Text input-->
				  <div class="span4">Alamat :</div>
				  <div class="span8">
					Jl. Dimana<br/>
					Semarang<br/>
					50001
				  </div>
				</li>
				<li class="clearfix">
				  <!-- Text input-->
				  <div class="span4">No. HP :</div>
				  <div class="span8">
					1234567890
				  </div>
				</li>
				<li class="clearfix">
				  <!-- Text input-->
				  <div class="span4">Email :</div>
				  <div class="span8">
					aaa@aaa.com
				  </div>
				</li>
				<li class="clearfix">
				  <!-- Text input-->
				  <div class="span4">Supervisor :</div>
				  <div class="span8">
					-
				  </div>
				</li>
			</ul>
			</div>
        </div>
      </div>
    </div>
    
</div>
@stop