<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel + Fondation</title>
	<link rel="stylesheet" href="foundation/css/foundation.min.css">
	<link rel="stylesheet" href="foundation/css/normalize.css">
	<link rel="stylesheet" href="wow/css/libs/animate.css">
	<style>
	    .wow:first-child {
	      visibility: hidden;
	    }
  	</style>	
</head>
<body>
	<div class="off-canvas-wrap" data-offcanvas> 
		<div class="inner-wrap"> 
			<nav class="tab-bar"> 
				<section class="left-small"> 
					<a class="left-off-canvas-toggle menu-icon" href="#">
						<span></span>
					</a> 
				</section> 
				<section class="middle tab-bar-section"> 
					<h1 class="title">Foundation</h1> 
				</section> 
				<section class="right-small"> 
					<a class="right-off-canvas-toggle menu-icon" href="#">
						<span></span>
					</a> 
				</section> 
			</nav> 
			<aside class="left-off-canvas-menu"> 
				<ul class="off-canvas-list"> 
					<li>
						<label>Foundation</label>
					</li> 
					<li>
						<a href="#">The Psychohistorians</a>
					</li> 
					<li>
						<a href="#">The Psychohistorians 2</a>
					</li> 
					<li>
						<a href="#">The Psychohistorians 3</a>
					</li> 
				</ul> 
			</aside> 
			<aside class="right-off-canvas-menu"> 
				<ul class="off-canvas-list"> 
					<li>
						<label>Users</label>
					</li> 
					<li>
						<a href="#">Hari Seldon</a>
					</li> 
					<li>
						<a href="#">Hari Seldon 2</a>
					</li> 
					<li>
						<a href="#">Hari Seldon 3</a>
					</li> 
				</ul> 
			</aside> 
			<section class="main-section" style="height:100%"> 
				<div data-magellan-expedition="fixed"> 
					<dl class="sub-nav"> 
						<dd data-magellan-arrival="arrival">
							<a href="#arrival">arrival</a>
						</dd> 
						<dd data-magellan-arrival="destination">
							<a href="#destination">destination</a>
						</dd> 
					</dl> 
				</div>
			</section> 
			<!-- Content goes right here!! -->
			<h3 data-magellan-destination="arrival">Arrival</h3> 
			<a name="arrival"></a>
			<div style="height:1000px">
				<img class="wow pulse" src="img/awan1.png" alt="gambar awan"></img>
				<img class="wow fadeInDownBig" src="img/awan2.png" alt="gambar awan"></img>
			</div>
			<h3 data-magellan-destination="destination">Destination</h3>
			<a name="destination"></a> 
			<div style="height:1000px">
				<div style="height:1000px">
					<img class="wow bounceInUp" src="img/awan1.png" alt="gambar awan"></img>
					<img class="wow bounceInRight" src="img/awan2.png" alt="gambar awan"></img>
				</div>
			</div>

			<a class="exit-off-canvas"></a> 
		</div> 
	</div>

	<script type="text/javascript" src="bootstrap/js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="foundation/js/foundation.min.js"></script>
	<script type="text/javascript" src="foundation/js/vendor/modernizr.js"></script>	
	<script>
    	$(document).foundation();
  	</script>
  	<script src="wow/dist/wow.js"></script>
	<script>
		wow = new WOW(
		  {
		    animateClass: 'animated',
		    offset:       100
		  }
		);
		wow.init();
		$(window).load(function() {
			$(".loader").fadeOut("slow");
		});
	</script>
</body>
</html>