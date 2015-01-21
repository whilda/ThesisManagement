<html>
	<head>
		<title>
			Eksplorasi Laravel
		</title>
	</head>
    <body>
        <div>
			<h1>Blade</h1>
			@yield('content')
		</div>
		<div>
			<h1>Php</h1>
			<?php			
				$users = DB::table('users')->get();
				foreach ($users as $user)
				{
					echo 'nama : '.$user->name.'<br />';
				}
			?>
		</div>
    </body>
</html>