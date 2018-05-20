<?php
	$str = $_POST['str'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$d = array();
	$mark = array();
	$mass = explode(";", $str);
	$unic = array();
	$dost = array();
	$leng = 0;
	//парсинг строки по ","
	//выявление уникальных символов
	foreach($mass as $key => $value){
		$mass[$key] = explode(",", $value);
		for($i = 0; $i < 2; $i++){
			$in = true;
			foreach($unic as $k => $v){
				if($mass[$key][$i] == $unic[$k]) {
					$in = false;
				}
			};
			if($in){
				array_push($unic, $mass[$key][$i]);
				$leng++;
			}
		}
	}
	//обьявление двумерного массива
	foreach($unic as $k => $v){
		$dost[$v] = array();
	}
	//присвоение всем элементам значение 0
	foreach($dost as $key => $value) {
		foreach($unic as $k => $v) {
			$dost[$key][$v] = 0;
		}
	}
	
	foreach($mass as $key => $value){
		$dost[$mass[$key][0]][$mass[$key][1]] = $mass[$key][2] * 1;
	}
	
	
	for ($i = 1; $i < ($leng*$leng - 1); $i++)
		$d[$i] = 2000000000;
	$d[0] = 0;
	
	for ($i = 1; $i < ($leng*$leng - 1); $i++){
		for ($j = 1; $j < ($leng*$leng - 1); $j++){
			if ($d[$dost[$j].$second] > $d[$dost[$j].$first] + $dost[$j].$value)
				$d[$dost[$j].$second] = $d[$dost[$j].$first] + $e[$j].$value;
			if ($d[$dost[$j].$first] > $d[$dost[$j].$second] + $dost[$j].$value)
				$d[$dost[$j].$first] = $d[$dost[$j].$second] + $dost[j].$value;
		}	
	}

	
	// отправка результата
	header('Content-type: application/json');
	echo json_encode($d);
?>
