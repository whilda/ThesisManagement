@extends('supervisor/layout')

@section('pageTitle')
	Nama Supervisor
@stop

@section('detail.nav') selected="selected" @stop
@section('detail.menu') active @stop

@section('content')

<div id="blog-posts">

    <div class="row-fluid">
      <div class="span12">
        <center><h4 style="font-size:25px"><strong>Nama Supervisor</strong></h4></center><br/>
        <div class="row-fluid">
			<div class="offset2 span2 thumbnail">
                <img src="{{ URL::to('/') }}/images/blog/442256_20337880.jpg" alt="">
			</div>
			<div class="span5">
			<ul class="item-summary">
				<li class="clearfix">
				  <!-- Text input-->
				  <div class="span4">NIP :</div>
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
				  <div class="span4">Mahasiswa :</div>
				  <div class="span8">
					30
				  </div>
				</li>
				<li class="clearfix">
				  <!-- Text input-->
				  <div class="span4">Expertise :</div>
				  <div class="span8">
					<a href="#"><span class="label label-info">A</span></a> 
					<a href="#"><span class="label label-info">B</span></a> 
					<a href="#"><span class="label label-info">C</span></a> 
					<a href="#"><span class="label label-info">D</span></a>
				  </div>
				</li>
				<li class="clearfix">
				<a class="btn btn-mini" href="edit">Edit</a>
				</li>
			</ul>
			</div>
        </div>
      </div>
    </div>
    
</div>
@stop