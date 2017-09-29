@extends('layouts.app')

@section('content')
    <?php

        include_once(__DIR__ . "/../../../database/gateway/ItemGateway.php");

        $g = new MonitorGateway();
        $r = $g->getAll();

        class Item {
            public $brand;
            public $price;
            public $quantity;
            public $processor_type;
            public $display_size;
            public $ram_size;
            public $cpu_cores;
            public $weight;
            public $type;
            public $width;
            public $height;
            public $thickness;
            public $battery;
            public $os;
            public $camera;
            public $touchscreen;

            public function __construct() {
                $this->brand = "brand";
                $this->price = 10.0;
                $this->quantity = 10;
                $this->processor_type = "ptype";
                $this->display_size = 10;
                $this->ram_size = 10;
                $this->cpu_cores = 10;
                $this->weight = 10;
                $this->width = 10;
                $this->height = 10;
                $this->thickness = 10;
                $this->battery = "battery";
                $this->os = "os";
                $this->type = "type";
                $this->camera = "camera";
                $this->touchscreen = true;
            }
        }

        $g->insert(new Item());
        echo '<pre>'; print_r($r); echo '</pre>';

    ?>
    <div class='jumbotron text-center'>
        <h1>{{$title}}</h1>
        <p>This is our new home page</p>
        <p><a class='btn btn-primary btn-lg' href='/login' role='button'>Login</a> <a class='btn btn-success btn-lg' href='/register' role='button'>Register</a>
    </div>
@endsection