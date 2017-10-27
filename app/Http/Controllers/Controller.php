<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $filterInputFloatArr = array('filter' => FILTER_VALIDATE_FLOAT,
        'options' => "decimal"
    );

    public $filterIntInputQty = array('filter' => FILTER_VALIDATE_INT,
        'options' => array('min_range' => 1, 'max_range' => 100)
    );
}
