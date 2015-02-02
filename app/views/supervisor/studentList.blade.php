@extends('supervisor/layout')

@section('pageTitle')
	Student List
@stop

@section('student.nav') selected="selected" @stop
@section('student.menu') active @stop

@section('content')
    <h2>Student List</h2>

<div id="blog-posts">

    <div class="row-fluid blog-post">
      <div class="span12">
        <h4><strong><a href="#">Nama Student</a></strong></h4>
        <div class="row-fluid">
            <a href="#" class="thumbnail pull-left">
                <img src="{{ URL::to('/') }}/images/blog/442256_20337880.jpg" alt="">
            </a>
            <div class="post-summary">      
                <p>
                  NIM: A11.2012.0????<br/>
                </p>
                <p><a class="btn btn-mini" href="supervisor">Lihat Detail</a></p>
            </div>
        </div>
        <div class="row-fluid details">
            <i class="icon-tags"></i> Field <a href="#"><span class="label label-info">A</span></a> 
            <a href="#"><span class="label label-info">B</span></a> 
            <a href="#"><span class="label label-info">C</span></a> 
            <a href="#"><span class="label label-info">D</span></a>
        </div>
      </div>
    </div>
    <div class="row-fluid blog-post">
      <div class="span12">
        <h4><strong><a href="#">Nama Student</a></strong></h4>
        <div class="row-fluid">
            <a href="#" class="thumbnail pull-left">
                <img src="{{ URL::to('/') }}/images/blog/442256_20337880.jpg" alt="">
            </a>
            <div class="post-summary">      
                <p>
                  NIM: A11.2012.0????<br/>
                </p>
                <p><a class="btn btn-mini" href="supervisor">Lihat Detail</a></p>
            </div>
        </div>
        <div class="row-fluid details">
            <i class="icon-tags"></i> Field <a href="#"><span class="label label-info">A</span></a> 
            <a href="#"><span class="label label-info">B</span></a> 
            <a href="#"><span class="label label-info">C</span></a> 
            <a href="#"><span class="label label-info">D</span></a>
        </div>
      </div>
    </div>
	<div class="row-fluid blog-post">
      <div class="span12">
        <h4><strong><a href="#">Nama Student</a></strong></h4>
        <div class="row-fluid">
            <a href="#" class="thumbnail pull-left">
                <img src="{{ URL::to('/') }}/images/blog/442256_20337880.jpg" alt="">
            </a>
            <div class="post-summary">      
                <p>
                  NIM: A11.2012.0????<br/>
                </p>
                <p><a class="btn btn-mini" href="supervisor">Lihat Detail</a></p>
            </div>
        </div>
        <div class="row-fluid details">
            <i class="icon-tags"></i> Field <a href="#"><span class="label label-info">A</span></a> 
            <a href="#"><span class="label label-info">B</span></a> 
            <a href="#"><span class="label label-info">C</span></a> 
            <a href="#"><span class="label label-info">D</span></a>
        </div>
      </div>
    </div>
	<div class="pagination">
	  <ul>
		<li class="disabled"><a href="#">Prev</a></li>
		<li class="active disabled"><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#">5</a></li>
		<li><a href="#">Next</a></li>
	  </ul>
	</div>

    
    
</div>
@stop