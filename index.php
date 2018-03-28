<!DOCTYPE html>
<html>
<head>
	<title>Jeu du pendu des pays</title>
	<style>
	#alphabet{
		border: 1px solid red;
	}
	#text{
		border: 1px solid blue;
	}
	ul{
		list-style: none;
	}
	button:hover{
		cursor: pointer;
	}
	</style>
</head>
<body>
	<h1>Jeu du pendu des pays</h1>
	<h2>Trouvez le nom du pays</h2>
	<button id="play">Jouer</button>
	<button id="stop">Voir la solution</button>

	<div>
		<div id="pendu"></div>
		<div id="text"></div>
		<div id="alphabet">
			<ul>
			</ul>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script>

		var wordID = null;
		$(function(){
			$('#play').click(function(){
				$.ajax({
					url: 'traitement.php',
					method: 'post',
					data: {
						get_function: 'get_country'
					},
					success : function(data){
						$("#text").empty();
						$("#alphabet ul").empty();
						wordID = data.id;
						alert(data.id +' '+data.name+' '+data.crypt);

						$("#text").append(data.crypt);

						var alphabet = data.alphabet.slice(0,26);

						$.each( alphabet, function( i, item ) {
 
						    var newListItem = "<li><button>" + item + "</button></li>";
						 
						    $("#alphabet ul").append( newListItem );
						 
						});
					},
					error : function(){
						alert('error');
					}
				});
			});


			$('#stop').click(function(){
				$.ajax({
					url: 'traitement.php',
					method: 'post',
					data: {
						get_function: 'get_solution',
						wordID: wordID
					},
					success : function(data){
						alert(data);
					},
					error : function(){
						alert('error');
					}
				});
			});

			$('#alphabet').on('click', 'button',function(){
				$.ajax({
					url: 'traitement.php',
					method: 'post',
					data: {
						get_function: 'get_attempt',
						letter: $(this).text(),
						crypt: $('#text').text()
					},
					success: function(){

					},
					error: function(){
						alert('error');
					}
				});
			});
		});
	</script>
</body>
</html>