<?php
	$str = $_POST['str'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$d = array();
	$mass = explode(";", $str);
	$unic = array();
	$dost = array();
	$leng = 0;
	$h = 0;
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
	
	$i = 0;
	$otr = -1;
	
	foreach($mass as $key => $value){

			if($mass[$key][0] == $start) {
				$d[$i] = $d[$i] + $mass[$key][2]; 
				foreach($mass as $k => $value){
					if($mass[$key][1] == $mass[$k][0] && $mass[$key][1] == $end ) {
						$d[$i] = $d[$i] + $mass[$k][2]; 
					} 
				}
				$i = $i + 1;
			}
		
	}
	

	// отправка результата
	header('Content-type: application/json');
	echo json_encode($d);
?>