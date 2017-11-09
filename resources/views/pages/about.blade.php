@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    <p>This is the about page</p>


    <?php

    use App\Mappers\ItemCatalogMapper;

    $mapper = ItemCatalogMapper::getInstance();

    $items = $mapper->selectAllItems();
    echo "<pre>";
    print_r($items);
    echo "</pre>";

        $newItemParam = [
            "id" => 23,
            "category" => "desktop",
            "brand" => "Alienware6666",
            "price" => "111111",
            "quantity" => 23,
            "processorType" => "NoIdea",
            "ramSize" => 16,
            "cpuCores" => 8,
            "weight" => 31.2,
            "hddSize" => 1000,
            "height" => 12,
            "width" => 12,
            "thickness" => 4
        ];

    $item = $mapper->modifyItem(4, 23, $newItemParam);

    echo "PRE COMMIT BUT REMOVE MSG SENT";
    echo "<pre>";
    print_r($items);
    echo "</pre>";

    $mapper->commit(4);

    $items = $mapper->selectAllItems();
    echo "POST COMMIT";
    echo "<pre>";
    print_r($items);
    echo "</pre>";

//    $newItemParam = [
//        "category" => "desktop",
//        "brand" => "Alienware",
//        "price" => "2400",
//        "quantity" => 23,
//        "processorType" => "NoIdea",
//        "ramSize" => 16,
//        "cpuCores" => 8,
//        "weight" => 31.2,
//        "hddSize" => 1000,
//        "height" => 12,
//        "width" => 12,
//        "thickness" => 4
//    ];
//    $newItemParam2 = [
//        "category" => "desktop",
//        "brand" => "Alienware3333",
//        "price" => "240022",
//        "quantity" => 23,
//        "processorType" => "NoIdea",
//        "ramSize" => 16,
//        "cpuCores" => 8,
//        "weight" => 31.2,
//        "hddSize" => 1000,
//        "height" => 12,
//        "width" => 12,
//        "thickness" => 4
//    ];
//    echo "BEFORE ANY TRANSACTION";
//
//
//    $mapper->addNewItem(1, 3, $newItemParam);
//    $mapper->addNewItem(2, 3, $newItemParam2);
//
//        echo "FIRST COMMIT";
//        $mapper->commit(1);
//        $items = $mapper->selectAllItems();
//
//        echo "<pre>";
//        print_r($items);
//        echo "</pre>";
//
//        echo "SECOND COMMIT";
//        $mapper->commit(2);
//        $items = $mapper->selectAllItems();

//        echo "<pre>";
//        print_r($items);
//        echo "</pre>";
//
//    echo "ONLY DESKTOPS";
//
//    $items = $mapper->selectAllItemType(3);
//
//    echo "<pre>";
//    print_r($items);
//    echo "</pre>";
    ?>

@endsection
