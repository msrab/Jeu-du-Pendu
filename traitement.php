<?php
	
	//Array of countries
	$words = ['Republique Tcheque',
					'Burkina Faso',
					'France',
					'Nauru',
					'Niger',
					'Bahamas',
					'Belgique',
					'Zimbabwe',
					'Emirats Arabes Unis',
					'Zambie',
					'Kosovo',
					'Liban',
					'tats-Unis',
					'Cameroun',
					'Turkmenistan',
					'Cambodge',
					'Tadjikistan',
					'Liberia',
					'Bosnie-Herzegovine',
					'Mali'
				];

	if(isset($_POST['get_function'])){
		$get_function = $_POST['get_function'];

		// Start the game
		if($get_function == 'get_word')
		{
			$wordID = get_random_wordID($words);
			$word = get_word($words, $wordID);

			$crypt_word = get_crypt_word($word, get_alphabet());
			$tab_word = str_split($crypt_word);

			$data = array(
				'id' => $wordID, 
				'crypt_word' => $tab_word,
				'alphabet' => get_alphabet()
			);

			return_data($data);
		}

		// Show the solution
		else if($get_function == 'get_solution')
		{
			$data = str_split(get_word($words, $_POST['wordID']));

			return_data($data);
		}

		// Game attempt
		else if($get_function == 'get_attempt')
		{
			$word = get_word($words, $_POST['wordID']);
			$data = get_compare_letter_word($_POST['letter'], str_split($word), $_POST['crypt_word']);

			return_data($data);
		}
	}


	/**
     * Choose a country from the table by random
     * 
     * @param Array $tab array of countries
     * @return int the country's id
     */
	function get_random_wordID(array $tab)
	{
		return array_rand($tab, 1);
	}

	/**
     * Get the country's name by position
     * 
     * @param Array $tab array of countries
     * @param int $id the country's id
     * @return string the country's name
     */
	function get_word(array $tab, int $id){
		return $tab[$id];
	}

	/**
     * Return the encrypted country's name
     * 
     * @param string $name the country's name
     * @param array $alphabet alphabet's array
     * @return string the encrypted country's name
     */
	function get_crypt_word(string $name, array $alphabet)
	{
		return str_replace($alphabet, '_', $name);
	}

	/**
     * Return the alphabet
     * 
     * @return array alphabet's array
     */
	function get_alphabet()
	{
		$tab = [];
		$j=0;
		$ascii = array(
					0 => array(65,90),
					1 => array(97,122));

		for($b = 0; $b < sizeof($ascii); $b++){
			for($i=$ascii[$b][0]; $i<=$ascii[$b][1]; $i++)
			{
		    	$tab[$j] = chr($i);
				$j++;
			}
		}

		return $tab;
	}

	/**
     * Check if the letter is in the country's name
     * 
     * @param string $letter the letter
     * @param array $word the country's name
     * @param array $crypt_word the encrypted country's name
     * @return array data
     */
	function get_compare_letter_word(string $letter, array $word, array $crypt_word)
	{
		$diff = 0;
		for($i=0; $i< sizeof($word); $i++){
			if($letter != strtoupper($word[$i]))
				continue;
			$crypt_word[$i] = $letter;
			$diff = 1;
		}

		return array(
			'crypt_word' =>$crypt_word,
			'diff' => $diff
		);
	}

	/**
     * Send the json's data
     * 
     * @param array $data 
     */
	function return_data($data)
	{
		header('Content-Type:application/json');
    	echo json_encode($data);
	}