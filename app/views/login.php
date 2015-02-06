<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Log In</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">





    <!-- For sample logo only-->
    <!--Remove if you no longer need this font-->
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/lib/AquafinaFont.css">
    <!--For sample logo only-->






    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo URL::to('/'); ?>/lib/font-awesome/css/font-awesome.css">
    <script src="<?php echo URL::to('/'); ?>/lib/jquery-1.7.2.min.js" type="text/javascript"></script>
    <script src="<?php echo URL::to('/'); ?>/javascripts/site.js" type="text/javascript"></script>
    
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/stylesheets/theme.css">


    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo URL::to('/'); ?>/assets/dinus.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo URL::to('/'); ?>/../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo URL::to('/'); ?>/../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo URL::to('/'); ?>/../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo URL::to('/'); ?>/../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->
    
    
    <div class="row-fluid login">
    <div class="dialog">
        <p class="brand" href=".">Awesome.</p>
		<div id="errMsg" class="alert alert-error" style="display:none" onclick="errMsg()"></div>
        <div class="block">
            <div class="block-header">
                <h2>Log In</h2>
            </div>
            <form name="login" method="post" action="<?php echo URL::to('/'); ?>/doAuth">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="span12">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="span12">
                    <label class="remember-me"><input type="checkbox" name="remember"> Remember Me</label>
					Don't have account? <a href="signup">Sign Up here</a>
                <div class="form-actions">
                    <input type="button" class="btn btn-success pull-right" value="Log In" onclick="auth()">
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>
</div>



    
    <script src="lib/bootstrap/js/bootstrap.js"></script>
	<script>
		function auth(){
			var error="";
			var username=document.login.username.value;
			var password=document.login.password.value;
			if(username==""){
				error+="<li>Username tidak boleh kosong</li>";
			}
			if(password==""){
				error+="<li>Password tidak boleh kosong</li>";
			}
			if(error==""){
				document.login.submit();
			}else{
				$("#errMsg").hide();
				$("#errMsg").html("<ul>"+error+"</ul>");
				$("#errMsg").slideDown();
			}
		}
	function errMsg(){
		$("#errMsg").slideUp();
	}
	</script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>



<html>