@extends('supervisor/student/layout')

@section('pageTitle')
	Student Name Tasks
@stop

@section('task.nav') selected="selected" @stop
@section('task.menu') active @stop

@section('content')
    <div class="span8 main-content">

    <div class="row-fluid">
        <div class="row-fluid">
            <h2>Student Name Tasks
                <span class="info">Ada 3 Task yang harus diselesaikan.</span>
            </h2>
			<a href="addTask" class="btn btn-mini">Tambah Task</a><br/><br/>
            <ul class="item-summary">
            

            
                <li>
                    <div class="overview">
                        <p class="main-detail">April 14th</p>
                        <p class="sub-detail">6:29 PM</p>
                        <span class="label label-success">Active</span> <span class="label label-info">New</span>
                    </div>
                    <div class="info">
                        <p>Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they.</p>
                        <a class="btn btn-mini" href="view/task">View Task</a>
                    </div>
                    <div class="clearfix"></div>
                </li>
            
                <li>
                    <div class="overview">
                        <p class="main-detail">Jan 24th</p>
                        <p class="sub-detail">6:29 PM</p>
                        <span class="label label-success">Active</span>
                    </div>
                    <div class="info">
                        <p>Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they.</p>
                        <a class="btn btn-mini" href="#">View Task</a>
                    </div>
                    <div class="clearfix"></div>
                </li>
            
                <li>
                    <div class="overview">
                        <p class="main-detail">May 9th</p>
                        <p class="sub-detail">5:25 PM</p>
                        <span class="label label-success">Active</span>
                    </div>
                    <div class="info">
                        <p>Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they.</p>
                        <a class="btn btn-mini" href="#">View Task</a>
                    </div>
                    <div class="clearfix"></div>
                </li>
            
                <li>
                    <div class="overview">
                        <p class="main-detail">June 3rd</p>
                        <p class="sub-detail">7:7 PM</p>
                        <span class="label label-success">Active</span>
                    </div>
                    <div class="info">
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