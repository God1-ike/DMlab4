<?php 
    ini_set('display_errors', 1);
    $data = $_POST['data'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $uniс = array();
    $un = array();
    //Проверка введенных данных
    $data = explode(";", $data);
    for($i = 0; $i < count($data); $i++) {
       
        $data[$i] = explode(",", $data[$i]);
        if(count($data[$i]) != 3 || !preg_match("/[0-9]/",$data[$i][2])) {
            echo "Ошибка при вводе";
            return;
        }
        $Prov = true;
        for($j = 0; $j < count($uniс); $j++) {
            if($uniс[$j] == $data[$i]) {
                $Prov = false;
                break;     
            }         
        }
        if($Prov != false) 
            array_push($uniс, $data[$i]);
    }
    //Выделение уникальных элементов
    for($i = 0; $i < count($uniс); $i++) {
        for($ii = 0; $ii < 2; $ii++) {
            $Prov = true;
            for($j = 0; $j < count($un); $j++) {
                if($un[$j] == $data[$i][$ii]) {
                    $Prov = false;
                    break;
                }
            }
            if($Prov == true)
            array_push($un, $uniс[$i][$ii]);
        }
    }
  
     //Получение координат соответствующих введенным парам
     for($i = 0; $i < count($uniс); $i++) {
        for($j = 0; $j < count($un); $j++) {
            if($un[$j] == $uniс[$i][0]) 
                $unarr[$i][0] = $j;
        }
        $temp_to = false;
        $temp_from = false;
        for($j = 0; $j < count($un); $j++) {
            if($end == $un[$j]) {
                if($temp_to == false)
                    $end = $j;
                $temp_to = true;
            }
            if($start == $un[$j]) {
                if($temp_from == false)
                $start = $j;
                    $temp_from = true;
            }
            if($un[$j] == $uniс[$i][1]) 
                $unarr[$i][1] = $j;
        }
        $unarr[$i][2] = $uniс[$i][2];
    }
    //Cоздание массива
    $mat = array();
    $path = array();
    for($i = 0; $i < count($un); $i++) {
        $mat[$i] = array();
        $path[$i] = array($start);
        $m[$i] = false;
        for($j = 0; $j < count($un); $j++) {
           $mat[$i][$j] = 99999;
        }
    }
    //Заполнение массива весами
    for($i = 0; $i < count($unarr); $i++) {
        $mat[$unarr[$i][0]][$unarr[$i][1]] = $uniс[$i][2];
    }
    //Нахождение кратчайшего пути
    $m[$start] = true;
    for($i = 0; $i < count($mat); $i++) {
        $leng =  array_search(min($mat[$i]),$mat[$i]);
        $m[$leng] = true;
        for($j = 0; $j < count($mat); $j++) {
            if($mat[$start][$j] > $mat[$start][$leng] + $mat[$leng][$j])  {
                $mat[$start][$j] = $mat[$start][$leng] + $mat[$leng][$j];
                $temp = $path[$leng];
                array_push($temp, $leng);
                $path[$j] = $temp;
            }
        }
    }
    array_push($path[$end], $end);
    for($i = 0; $i < count($path[$end]); $i++) {
        $path[$end][$i] = $un[$path[$end][$i]];
    }
    $out[0] = $path[$end];
    $out[1] = $mat[$start][$end];
	
    echo json_encode($out);
?>
