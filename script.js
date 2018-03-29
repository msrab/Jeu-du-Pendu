
var wordID = null;
var crypt_word = null;
var essays = 0;


$(function(){

	// START THE GAME
	$('#play').click(function(){

		$.ajax({
			url: 'traitement.php',
			method: 'post',
			data: {
				get_function: 'get_word'
			},
			success : function(data){

				// INITIALIZATION
				$("#text").empty();
				$('#message').empty();
				$("#alphabet ul").empty();

				$('#message').removeClass();
				add_class("#pendu div", 'hide');

				essays = 0;
				wordID = data.id;

				crypt_word = data.crypt_word;

				// Display the encrypted country's name
				display_text(data.crypt_word);

				//Show letters
				display_alphabet(data.alphabet.slice(0,26));
			},
			error : function(){
				alert('error');
			}
		});
	});

	// DISPLAY THE SOLUTION
	$('#stop').click(function(){
		$.ajax({
			url: 'traitement.php',
			method: 'post',
			data: {
				get_function: 'get_solution',
				wordID: wordID
			},
			success : function(data){

				$("#text").empty();

				display_text(data);
				add_class("#alphabet a", 'disabled');
			},
			error : function(){
				alert('error');
			}
		});
	});

	// GAME ATTEMPT
	$('#alphabet').on('click', 'a',function(){

		var letter = $(this).text();

		$.ajax({
			url: 'traitement.php',
			method: 'post',
			data: {
				get_function: 'get_attempt',
				wordID: wordID,
				letter: letter,
				crypt_word: crypt_word
			},
			success: function(data){

				// if failed attempt
				if(data.diff == 0)
				{
					$('.pendu-'+ essays).removeClass('hide');
					essays++;
				}

				// if lose
				if(essays >= 7)
				{
					get_message('lose', 'Vous avez perdu. Dommage! :(');
					add_class("#alphabet a", 'disabled');
				}
				else
				{
					// disable letter
					$('#alphabet #'+letter).addClass('disabled');
					$("#text").empty();

					crypt_word = data.crypt_word;
					display_text(crypt_word);

					// check if there are still letters to look for
					var game = 0;
					for(var i = 0; i < crypt_word.length; i++){
					 	if(crypt_word[i] == '_')
					 		game++;
					}

					// if win
					if(game == 0){
						get_message('win', 'Vous avez gagnez. Bravo! :D');
						add_class("#alphabet a", 'disabled');
					}
				}

			},
			error: function(){
				alert('error');
			}
		});
	});
});

/**
 * Display the message if you win or lose
 * 
 * @param the class
 * @param the message
 */
function get_message(classe, message)
{
	$("#message").addClass(classe).append(message);
}

/**
 * Add class in a selector
 * 
 * @param the selector
 * @param the class
 */
function add_class(selector, classe)
{
	$(selector).addClass(classe);
}

/**
 * Display the text 
 * 
 * @param data the country's name (encrypted or not)
 */
function display_text(data)
{
	$.each( data, function( i, item ) {
			if(item === ' ')
				item = '<span class="space"></span>';
	    var newListItem =  item + ' ';
	 
	    $("#text").append( newListItem );
	 
	});
}

/**
 * Display letters
 * 
 * @param alphabet's array
 */
function display_alphabet(data)
{
	$.each( data, function( i, item ) {
		var newListItem = "<li><a id='" 
							+ item 
							+ "' class='waves-effect waves-light btn col s2'>" 
							+ item 
							+ "</a></li>";
	 	$("#alphabet ul").append( newListItem );
	 
	});
}
