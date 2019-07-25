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

    $random = rand(0,1);
    if ($random){
        $newArr = json_decode(file_get_contents('output.json'), true);
        $newArr['Fruits']['Apples'] = 120;

        file_put_contents('output2.json', json_encode($newArr));
    }else {
        file_put_contents('output2.json', json_encode($array));
    }

    $output = json_decode(file_get_contents('output.json'), true);
    $output2 = json_decode(file_get_contents('output2.json'), true);

    $result = array_diff_assoc($output['Fruits'], $output2['Fruits']);

    if($result){
        echo 'Файлы отличаются ';
        print_r($result);
    }else{
        echo 'Файлы одинаковые';
    }
}