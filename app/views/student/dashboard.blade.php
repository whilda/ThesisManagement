@extends('student/layout')

@section('pageTitle')
	Dashboard
@stop

@section('addResourceTop')
	<style>
		.info h2{
			margin:0;
		}
	</style>
@stop

@section('dashboard.nav') selected="selected" @stop
@section('dashboard.menu') active @stop

@section('content')
    <div class="span8 main-content">

    <div class="row-fluid">
        <div class="row-fluid">
			@if ($data['thesis']['topic']=="")
			<div class="alert"><a href="thesis">Anda belum mengisi thesis</a></div>
			@endif
            <h2>Available Tasks
                <span class="info">Ada {{ count($data['task']) }} Task yang harus diselesaikan.</span>
            </h2>
            <ul class="item-summary">
            

            
                <li>
                    <div class="overview span4">
                        <p class="main-detail">April 14th</p>
                        <p class="sub-detail"> </p>
                        <span class="label label-success">Active</span> <span class="label label-info">New</span>
                    </div>
                    <div class="info span8">
						<h2>Nama Task yang Panjang Sekali</h2>
                        <p>Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they.</p>
                        <a class="btn btn-mini" href="#">View Task</a>
                    </div>
                    <div class="clearfix"></div>
                </li>
            
                <li>
                    <div class="overview span4">
                        <p class="main-detail">Jan 24th</p>
                        <p class="sub-detail"> </p>
                        <span class="label label-success">Active</span>
                    </div>
                    <div class="info span8">
						<h2>Nama Task yang Panjang Sekali</h2>
                        <p>Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they.</p>
                        <a class="btn btn-mini" href="#">View Task</a>
                    </div>
                    <div class="clearfix"></div>
                </li>
            
                <li>
                    <div class="overview span4">
                        <p class="main-detail">May 9th</p>
                        <p class="sub-detail"> </p>
                        <span class="label label-success">Active</span>
                    </div>
                    <div class="info span8">
						<h2>Nama Task yang Panjang Sekali</h2>
                        <p>Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they.</p>
                        <a class="btn btn-mini" href="#">View Task</a>
                    </div>
                    <div class="clearfix"></div>
                </li>
            
                <li>
                    <div class="overview span4">
                        <p class="main-detail">June 3rd</p>
                        <p class="sub-detail"> </p>
                        <span class="label label-success">Active</span>
                    </div>
                    <div class="info span8">
						<h2>Nama Task yang Panjang Sekali</h2>
                        <p>Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they.</p>
                        <a class="btn btn-mini" href="#">View Task</a>
                    </div>
                    <div class="clearfix"></div>
                </li>
            
            </ul>
        </div>
	</div>
</div>
@stop