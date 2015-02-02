@extends('supervisor/layout')

@section('pageTitle')
	Student Proposal
@stop

@section('proposal.nav') selected="selected" @stop
@section('proposal.menu') active @stop

@section('content')
    <h2>Task Templates</h2>
  <div id="blog-posts">

    <div class="row-fluid blog-post">
      <div class="span12">
        <h4><strong><a href="#">Username</a></strong></h4>
        <div class="row-fluid">
            <div class="post-summary">   
				NIM: A11.2012.0????<br/>
				Topic:
				<p>
                  ................
                </p>
                Deskripsi:
				<p>
                  ...........<br/>
				  .................<br/>
                </p>
                <p><a class="btn btn-mini" href="#">Accept</a> <a class="btn btn-mini" href="#">Decline</a></p>
            </div>
        </div>
      </div>
    </div>
	<div class="row-fluid blog-post">
      <div class="span12">
        <h4><strong><a href="#">Username</a></strong></h4>
        <div class="row-fluid">
            <div class="post-summary">   
				NIM: A11.2012.0????<br/>
				Topic:
				<p>
                  ................
                </p>
                Deskripsi:
				<p>
                  ...........<br/>
				  .................<br/>
                </p>
                <p><a class="btn btn-mini" href="#">Accept</a> <a class="btn btn-mini" href="#">Decline</a></p>
            </div>
        </div>
      </div>
    </div>
	<div class="pagination">
	<center>
	  <ul>
		<li class="disabled"><a href="#">Prev</a></li>
		<li class="active disabled"><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#">5</a></li>
		<li><a href="#">Next</a></li>
	  </ul>
	</center>
	</div>

    
    
</div>
@stop