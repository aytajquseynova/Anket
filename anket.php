<?php

// function control($a){
//     $result = 0;
//     if(strlen($a) > 0){
//         $result = 1;
//     }
//     return $result;
// }

function percent($user, $book){
    $calc = ($book * 100) / 10;
    return $calc;
}

$file = "anket.txt";
if(isset($_POST['send'])){
    if( !empty ($_POST['book']) && isset($_POST['book'])){
        $book = $_POST['book'];
        // phpde ip alma
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = date("d/m/Y");
        $add = $book . ";" . $ip . ";" . $date . "\n";
        $write = fopen($file, "a");
        fwrite($write, $add);
        fclose($write);
        echo "Ankete qatildiginiz ucun tesekkurler";
    }else{
        echo "Lutfen bir kitab secin";
    }

}
elseif(isset($_POST["showResult"])){
    if(file_exists($file)){
        // echo "Arama basladi..."."<br>";
        $read = fopen($file, "r");
        $dosto = 0;
        $zweig = 0;
        $camus = 0;
        $exupery = 0;
        $userCount = 0;
        while (!feof($read)) {
            $userCount++;
            $line = fgets($read);
            $arr = explode(";", $line);
            if($arr[0]== "Yeraltindan notlar"){
                $dosto++;
            }
            elseif ($arr[0] == "Sahmat") {
                $zweig++;
            }
            elseif ($arr[0] == "Yad") {
                $camus++;
            } 
            else {
                $exupery++;
            }
        }
        echo "Yeraltindan notlar oxuyan sayi: " . $dosto . "<br>";
        echo "Sahmat notlar oxuyan sayi: " . $zweig . "<br>";
        echo "Yad oxuyan sayi: " . $camus . "<br>";
        echo "Balaca sahzade oxuyan sayi: " . $exupery . "<br>";
        echo "----------------------------------------"."<br>";
        $dostoPercent = percent($userCount, $dosto);
        $zweigPercent = percent($userCount, $zweig);
        $camusPercent = percent($userCount, $camus);
        $exuperyPercent = percent($userCount, $exupery);
        echo "Yeraltindan notlar : $dostoPercent %;"."<br>";
        echo "Sahmat : $zweigPercent %;" . "<br>";
        echo "Yad : $camusPercent %;" . "<br>";
        echo "Balaca sahzade : $exuperyPercent %; " . "<br>";


    }else{
        echo "Ankete hele hec kim qatilmayibdir";
    }
}


?>