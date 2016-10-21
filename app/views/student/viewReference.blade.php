@extends('supervisor/layout')

@section('pageTitle')
	Reference Detail
@stop

@section('library.nav') selected="selected" @stop
@section('library.menu') active @stop


@section('content')
    <h2>Detail Referensi</h2>
	<div class="alert alert-error" id="notifMsg" style="display:none" onclick="notifMsg()"></div>
  <form class="form-horizontal" name="edit">
    <div class="span12  ">
        <div class="span3">
        Author
        </div>
        <div class="span9">
        : {{ $data['author'] }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="span3">
        Title
        </div>
        <div class="span9">
        : {{ $data['title'] }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="span3">
        Year
        </div>
        <div class="span9">
        : {{ $data['year'] }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="span3">
        Abstract
        </div>
        <div class="span9">
        : {{ $data['abstract'] }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="span3">
        Keywords
        </div>
        <div class="span9">
        : @foreach($data['keywords'] as $keyword) <span class="label label-info">{{ $keyword }}</span> @endforeach
        </div>
    </div>

  </form>
@stop