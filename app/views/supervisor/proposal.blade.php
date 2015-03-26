@extends('supervisor/layout')

@section('pageTitle')
	Student Proposal
@stop

@section('proposal.nav') selected="selected" @stop
@section('proposal.menu') active @stop

@section('content')
    <h2>Student Proposal</h2>
  <div id="blog-posts">
	@if(count($data)!=0)
	@foreach($data as $proposal)
    <div class="row-fluid blog-post">
      <div class="span12">
        <h4><strong><a href="#">{{ $proposal['username'] }}</a></strong></h4>
        <div class="row-fluid">
            <div class="post-summary">   
				NIM: {{ $proposal['nim'] }}<br/>
				Topic:
				<p>
                  {{ $proposal['topic'] }}
                </p>
                Deskripsi:
				<p>
                  {{ nl2br(htmlentities($proposal['description'])) }}
                </p>
                <p><a class="btn btn-mini" href="{{ URL::to('/') }}/supervisor/proposal/accept/{{ $proposal['username'] }}">Accept</a> <a class="btn btn-mini" href="{{ URL::to('/') }}/supervisor/proposal/decline/{{ $proposal['username'] }}">Decline</a></p>
            </div>
        </div>
      </div>
    </div>
	  @endforeach
	@else
		Tidak ada proposal terdaftar.
	@endif
    </div>
	@if(isset($pagination))
	<div class="pagination">
	<center>
	  <ul>
		{{ $pagination }}
	  </ul>
	</center>
	</div>
	@endif

    
    
</div>
@stop