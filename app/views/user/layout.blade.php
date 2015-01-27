<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>@yield('pageTitle')</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">





    <!-- For sample logo only-->
    <!--Remove if you no longer need this font-->
    <link rel="stylesheet" type="text/css" href="lib/AquafinaFont.css">
    <!--For sample logo only-->






    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">
    <script src="lib/jquery-1.7.2.min.js" type="text/javascript"></script>
    <script src="javascripts/site.js" type="text/javascript"></script>
	@yield('addResource')
	<link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/dinus.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->
    
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                    <li class="hidden-phone"><a href="#" role="button">Settings</a></li>
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> Jack Smith
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="profile">Profile</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" class="visible-phone" href="#">Settings</a></li>
                            <li class="divider visible-phone"></li>
                            <li><a tabindex="-1" href="sign-in.html">Logout</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <a class="brand" href="index.html">Student Dashboard</a>
        </div>
    </div>

    <div id="main-menu">
        
        <div id="phone-navigation">
            <select class="selectnav" id="phone-menu">
                
                <option value="home" @yield('dashboard.nav')> Dashboard</option>
                    
                <option value="thesis" @yield('thesis.nav')> Thesis</option>
                    
                <option value="supervisorList" @yield('super.nav')> Supervisor List</option>
                    
                <option value="code" @yield('code.nav')> Input Code</option>
                    
                <option value="timeline" @yield('timeline.nav')> Time Line</option>
                    
                <option value="report" @yield('report.nav')>Final Report</option>
                    
                <option value="profile" @yield('profile.nav')>Profile</option>
                    
            </select>
        </div>

        <ul class="nav nav-tabs">
            <li class="@yield('dashboard.menu') "><a href="home"><i class="icon-home"></i> <span>Dashboard</span></a></li>
			<li class="@yield('thesis.menu') "><a href="thesis"><i class="icon-book"></i> <span>Thesis</span></a></li>
			<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> Supervisor <b class="caret"></b></a>
                <ul class="dropdown-menu">
					<li class=" "><a href="supervisorList"><i class="icon-group"></i> <span>Supervisor List</span></a></li>
					<li class=" "><a href="code"><i class="icon-pencil"></i> <span>Input Code</span></a></li>
                </ul>
            </li>
            <li class="@yield('timeline.menu') "><a href="timeline"><i class="icon-calendar"></i> <span>Time Line</span></a></li>
            <li class="@yield('report.menu') "><a href="report"><i class="icon-pushpin"></i> <span>Final Report</span></a></li>
        </ul>
    </div>
    
    
    <div id="sidebar-nav">
        
        <ul id="dashboard-menu" class="nav nav-list">
            
            <li class="@yield('dashboard.menu') "><a href="home"><i class="icon-home"></i> <span>Dashboard</span></a></li>
            
			
            <li class="@yield('thesis.menu') "><a href="thesis"><i class="icon-book"></i> <span>Thesis</span></a></li>
			
            
            <li class="@yield('super.menu') "><a href="supervisorList"><i class="icon-group"></i> <span>Supervisor List</span></a></li>
            
            
			<li class="@yield('code.menu') "><a href="code"><i class="icon-pencil"></i> <span>Input Code</span></a></li>
			            
            
            <li class="@yield('timeline.menu') "><a href="timeline"><i class="icon-calendar"></i> <span>Time Line</span></a></li>
            
            
            <li class="@yield('report.menu') "><a href="report"><i class="icon-pushpin"></i> <span>Final Report</span></a></li>
            
            
            <li class="@yield('profile.menu') "><a href="profile"><i class="icon-user"></i> <span>Profile</span></a></li>
        </ul>
    </div>
    
    <div class="content">
        <div class="container-fluid">
            <div class="row-fluid">
				<div style="min-height:430px">
				@yield('content')
				</div>
				<footer>
                    <hr>
                    <p class="pull-right">Design by <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
                    <p>&copy; 2013 <a href="#">Your Company</a></p>
                </footer>
                
            </div>
        </div>
    </div>
    
    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>



<html>