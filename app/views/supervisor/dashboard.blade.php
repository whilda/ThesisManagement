@extends('supervisor/layout')

@section('pageTitle')
	Dashboard
@stop

@section('dashboard.nav') selected="selected" @stop
@section('dashboard.menu') active @stop

@section('content')
    <div class="span8 main-content">

    <div class="row-fluid">
        <div class="row-fluid">
            <h2>Students' Progress
                <span class="info"></span>
            </h2>
            <ul class="item-summary">
            

            
                <li>
					<div class="span3">
						<div class="thumbnail">
							<img src="{{ URL::to('/') }}/images/blog/442256_20337880.jpg" alt="">
						</div>
						<center>
						<p style="font-weight:bold">Nama Lengkap Student</p>
						<p class="sub-detail">A11.2012.06678</p>
						</center>
					</div>
					<div class="span9">
						<div>
						  <!-- Text input-->
						  <div class="span3">Topic :</div>
						  <div class="span9">
							Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they.
						  </div>
						</div>
						<div>
						  <!-- Text input-->
						  <div class="span3">Title :</div>
						  <div class="span9">
							Trust fund photo letterpress.
						  </div>
						</div>
						<div>
						  <!-- Text input-->
						  <div class="span3">Description :</div>
						  <div class="span9">
							Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they. 
							Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they. 
							Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they.
						  </div>
						</div>
						<div>
						  <!-- Text input-->
						  <div class="span3">Field :</div>
						  <div class="span9">
							<a href="#"><span class="label label-info">A</span></a> 
							<a href="#"><span class="label label-info">B</span></a> 
							<a href="#"><span class="label label-info">C</span></a> 
							<a href="#"><span class="label label-info">D</span></a>
						  </div>
						</div>
						<div>
						  <!-- Text input-->
						  <div class="span3">Progress :</div>
						  <div class="span9">
							<ul class="unstyled">
							<li>3/8 Tasks Completed <span class="pull-right strong">37.5%</span>
								<div class="progress progress-important">
									<div class="bar" style="width: 37.5%;"></div>
								</div>
							</li>
							</ul>
						  </div>
						</div>
						<div class="clearfix">
						<a class="btn btn-mini" href="#">Lihat Mahasiswa</a>
						</div>
					</div>
                    <div class="clearfix"></div>
                </li>
				<li>
					<div class="span3">
						<div class="thumbnail">
							<img src="{{ URL::to('/') }}/images/blog/442256_20337880.jpg" alt="">
						</div>
						<center>
						<p style="font-weight:bold">Nama Lengkap Student</p>
						<p class="sub-detail">A11.2012.06678</p>
						</center>
					</div>
					<div class="span9">
						<div>
						  <!-- Text input-->
						  <div class="span3">Topic :</div>
						  <div class="span9">
							Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they.
						  </div>
						</div>
						<div>
						  <!-- Text input-->
						  <div class="span3">Title :</div>
						  <div class="span9">
							Trust fund photo letterpress.
						  </div>
						</div>
						<div>
						  <!-- Text input-->
						  <div class="span3">Description :</div>
						  <div class="span9">
							Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they. 
							Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they. 
							Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they.
						  </div>
						</div>
						<div>
						  <!-- Text input-->
						  <div class="span3">Field :</div>
						  <div class="span9">
							<a href="#"><span class="label label-info">A</span></a> 
							<a href="#"><span class="label label-info">B</span></a> 
							<a href="#"><span class="label label-info">C</span></a> 
							<a href="#"><span class="label label-info">D</span></a>
						  </div>
						</div>
						<div>
						  <!-- Text input-->
						  <div class="span3">Progress :</div>
						  <div class="span9">
							<ul class="unstyled">
							<li>7/8 Tasks Completed <span class="pull-right strong">87.5%</span>
								<div class="progress progress-important">
									<div class="bar" style="width: 87.5%;"></div>
								</div>
							</li>
							</ul>
						  </div>
						</div>
						<div class="clearfix">
						<a class="btn btn-mini" href="#">Lihat Mahasiswa</a>
						</div>
					</div>
                    <div class="clearfix"></div>
                </li>
            </ul>
        </div>
</div>
@stop