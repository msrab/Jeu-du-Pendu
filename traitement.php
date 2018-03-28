<?php

		$countries = ['Republique Tcheque',
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
						'Etats-Unis',
						'Cameroun',
						'Turkmenistan',
						'Cambodge',
						'Tadjikistan',
						'Liberia',
						'Bosnie-Herzegovine',
						'Mali'];

	if(isset($_POST['get_function'])){
		$get_function = $_POST['get_function'];

		if($get_function == 'get_country'){
			$countryID = get_random_countryID($countries);
			$countryName = get_countryName($countries, $countryID);
			$crypt_countryName = get_crypt_countryName($countryName, get_alphabet());
			$nbr_char = array(
				'id' => $countryID, 
				'name' => $countryName, 
				'crypt' => $crypt_countryName,
				'alphabet' => get_alphabet()
			);

			header('Content-Type:application/json');
	    	echo json_encode($nbr_char);
		}
		else if($get_function == 'get_solution'){
			$countryName = get_countryName($countries, $_POST['countryID']);
			header('Content-Type:text/plain');
	    	echo $countryName;
		}
		else if($get_function == 'get_attempt'){

		}
	}


	function get_random_countryID(array $tab)
	{
		return array_rand($tab, 1);
	}

	function get_countryName(array $tab, int $id){
		return $tab[$id];
	}

	function get_crypt_countryName(string $name, array $alphabet)
	{
		return str_replace($alphabet, '_', $name);
	}

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

	function get_compare_letter_word(string $letter, string $word, string $crypt)
	{
		
	}

	