<!DOCTYPE html>
<html>
<head>
	<title>JEU DU PENDU</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
	<link rel="stylesheet" href="style.css">
</head>
<body class="container">
	<div>
		<h1>JEU DU PENDU - <span>Trouve le nom du pays</span></h1>
		<a id="play" class="waves-effect waves-light btn-large">Jouer</a>
		<a id="stop"  class="waves-effect waves-light btn-large">Voir la solution</a>
		<div id="message"></div>
	</div>

	<div class="row">
		<div id="pendu" class="col s5">
			<div class="pendu-0 hide"></div>
			<div class="pendu-1 hide"></div>
			<div class="pendu-2 hide"></div>
			<div class="pendu-3 hide"></div>
			<div class="pendu-4 hide"></div>
			<div class="pendu-5 hide"></div>
			<div class="pendu-6 hide"></div>
		</div>
		<div class="col s7">
			<div class="container">
				<div id="text" class="center-align"></div>
				<div id="alphabet" class="">
					<ul class="row"></ul>
				</div>
			</div>
		</div>
		
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
	<script src="script.js"></script>
</body>
</html>