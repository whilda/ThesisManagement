@extends('supervisor/layout')

@section('pageTitle')
	Task Template
@stop

@section('template.nav') selected="selected" @stop
@section('template.menu') active @stop

@section('content')
    <h2>Task Templates</h2>
	<a class="btn btn-mini" href="addTemplate">Tambah Template</a>
  <div id="blog-posts">

    <div class="row-fluid blog-post">
      <div class="span12">
        <h4><strong><a href="#">Nama Template</a></strong></h4>
        <div class="row-fluid">
            <div class="post-summary">      
                Deskripsi:
				<p>
                  ...........<br/>
				  .................<br/>
                </p>
                <p><a class="btn btn-mini" href="template/name/edit">Edit</a> <a class="btn btn-mini" href="supervisor">Delete</a></p>
            </div>
        </div>
		<div class="row-fluid details">
            <i class="icon-tasks"></i> Tasks: 0
        </div>
      </div>
    </div>
	<div class="row-fluid blog-post">
      <div class="span12">
        <h4><strong><a href="#">Nama Template</a></strong></h4>
        <div class="row-fluid">
            <div class="post-summary">      
                Deskripsi:
				<p>
                  ...........<br/>
				  .................<br/>
                </p>
                <p><a class="btn btn-mini" href="editTemplate">Edit</a> <a class="btn btn-mini" href="supervisor">Delete</a></p>
            </div>
        </div>
		<div class="row-fluid details">
            <i class="icon-tasks"></i> Tasks: 2
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