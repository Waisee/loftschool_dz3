<?php

function task1($filename)
{
    $fileData = file_get_contents($filename);

    $xml = new SimpleXMLElement($fileData);

    echo 'Номер заказа: ' .  $xml->attributes()->PurchaseOrderNumber . '<br>';
    echo 'Дата заказа: ' . $xml->attributes()->OrderDate . '<br><br>';

    foreach ($xml->Address as $address){
        echo $address->attributes()->Type . ' адрес:<br>';
        echo 'Имя: ' . $address->Name . '<br>';
        echo 'Улица: ' . $address->Street . '<br>';
        echo 'Город: ' . $address->City . '<br>';
        echo 'Штат: ' . $address->State . '<br>';
        echo 'Индекс: ' . $address->Zip . '<br>';
        echo 'Страна: ' . $address->Country . '<br><br>';
    }

    echo 'Записка: ' . $xml->DeliveryNotes . '<br><br>';
    echo 'Товары: <br><br>';
    foreach ($xml->Items->Item as $item){
        echo 'Номер партии: ' . $item->attributes()->PartNumber . '<br>';
        echo 'Наименование: ' . $item->ProductName . '<br>';
        echo 'Количество: ' . $item->Quantity . '<br>';
        echo 'Цена: ' . $item->USPrice . '<br>';

        if(isset($item->Comment)){
            echo 'Комментарий: ' . $item->Comment . '<br><br>';
        }

        if(isset($item->ShipDate)){
            echo 'Дата доставки: ' . $item->ShipDate . '<br><br>';
        }
    }
}

function task2($array)
{
    file_put_contents('output.json', json_encode($array));

    $json1 = json_decode(file_get_contents('output.json'), true);

    $random = rand(0,1);
    if ($random){

        echo 'Массив изменен<br>';
        $json1['Fruits']['Apples'] = 120;

    }

    file_put_contents('output2.json', json_encode($json1));

    $output = json_decode(file_get_contents('output.json'), true);
    $output2 = json_decode(file_get_contents('output2.json'), true);

//    $diff1 = array_diff_assoc($output, $output2);
//    $diff2 = array_diff_assoc($output2, $output);
    /**
     * @param $array1
     * @param $array2
     * @return array
     * Returns difference of two n-dimensional arrays
     */
    function array_diff_assoc_recursive($array1, $array2) {
        $difference=array();
        foreach($array1 as $key => $value) {
            if( is_array($value) ) {
                if( !isset($array2[$key]) || !is_array($array2[$key]) ) {
                    $difference[$key] = $value;
                } else {
                    $new_diff = array_diff_assoc_recursive($value, $array2[$key]);
                    if( !empty($new_diff) )
                        $difference[$key] = $new_diff;
                }
            } else if( !array_key_exists($key,$array2) || $array2[$key] !== $value ) {
                $difference[$key] = $value;
            }
        }
        return $difference;
    }

    $diff1 = array_diff_assoc_recursive($output, $output2);
    $diff2 = array_diff_assoc_recursive($output2, $output);

    if(!empty($diff1 || $diff2)){
        echo 'Разница в массивах: ';
        echo '<pre>';
        print_r($diff1);
        print_r($diff2);

    }else{
        echo 'Разницы нет<br>';
    }
}

function task3(array $array)
{
    echo '<pre>';

    $file = fopen('file.csv', 'w');

    if(!$file){
        die("Can't open file");
    }
    foreach ($array as $item){
        fputcsv($file, $item);
    }

    $newfile = fopen('file.csv', 'r');
    $ret = [];

    while($str = fgetcsv($newfile)){
        if($str[0] % 2 == 0){
            $ret[] = $str[0];
        }
    }

    echo 'Сумма четных чисел массива: ' . array_sum($ret);

}

