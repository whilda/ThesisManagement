@extends('student/layout')

@section('pageTitle')
	Supervisor List
@stop

@section('super.nav') selected="selected" @stop
@section('super.menu') active @stop

@section('content')
    <h2>Supervisor List</h2>

<div id="blog-posts">

    <div class="row-fluid blog-post">
      <div class="span12">
        <h4><strong><a href="#">Nama Supervisor</a></strong></h4>
        <div class="row-fluid">
            <a href="#" class="thumbnail pull-left">
                <img src="{{ URL::to('/') }}/images/blog/442256_20337880.jpg" alt="">
            </a>
            <div class="post-summary">      
                <p>
                  Email: aaa@aaa.com<br/>
                </p>
                <p><a class="btn btn-mini" href="supervisor">Lihat Detail</a> <a class="btn btn-mini" href="#">Pilih Supervisor</a></p>
            </div>
        </div>
        <div class="row-fluid details">
            <i class="icon-user"></i> Mahasiswa: 30 orang 
            | <i class="icon-tags"></i> Expertise <a href="#"><span class="label label-info">A</span></a> 
            <a href="#"><span class="label label-info">B</span></a> 
            <a href="#"><span class="label label-info">C</span></a> 
            <a href="#"><span class="label label-info">D</span></a>
        </div>
      </div>
    </div>
    <div class="row-fluid blog-post">
      <div class="span12">
        <h4><strong><a href="#">Nama Supervisor</a></strong></h4>
        <div class="row-fluid">
            <a href="#" class="thumbnail pull-left">
                <img src="{{ URL::to('/') }}/images/blog/442256_20337880.jpg" alt="">
            </a>
            <div class="post-summary">      
                <p>
                  Email: aaa@aaa.com<br/>
                </p>
                <p><a class="btn btn-mini" href="supervisor">Lihat Detail</a> <a class="btn btn-mini" href="#">Pilih Supervisor</a></p>
            </div>
        </div>
        <div class="row-fluid details">
            <i class="icon-user"></i> Mahasiswa: 30 orang 
            | <i class="icon-tags"></i> Expertise <a href="#"><span class="label label-info">Official</span></a> 
            <a href="#"><span class="label label-info">Announcements</span></a> 
            <a href="#"><span class="label label-info">News</span></a> 
            <a href="#"><span class="label label-info">New Features</span></a>
        </div>
      </div>
    </div>

    
    
</div>
@stop