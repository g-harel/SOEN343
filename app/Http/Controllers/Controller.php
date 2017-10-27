<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    // utility
    public $filterInputFloatArr = array(
        'filter' => FILTER_VALIDATE_FLOAT,
        'options' => "decimal"
    );

    // utility
    public $filterIntInputQty = array(
        'filter' => FILTER_VALIDATE_INT,
        'options' => array('min_range' => 1, 'max_range' => 999)
    );

    public function desktopValidationFormInputs() {
        return [
            'desktop-qty' => $this->filterIntInputQty,
            'computer-brand' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'desktop-processor' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'desktop-ram-size' => FILTER_VALIDATE_INT,
            'storage-capacity' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'desktop-cpu-cores' => FILTER_VALIDATE_INT,
            'desktop-price' => $this->filterInputFloatArr,
            'desktop-weight' => $this->filterInputFloatArr,
            'desktop-height' => $this->filterInputFloatArr,
            'desktop-width' => $this->filterInputFloatArr,
            'desktop-thickness' => $this->filterInputFloatArr
        ];
    }

    public function laptopValidationFormInputs() {
        return [
            'laptop-qty' => $this->filterIntInputQty,
            'laptop-brand' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'laptop-processor' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'laptop-ram-size' => FILTER_VALIDATE_INT,
            'laptop-storage-capacity' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'laptop-cpu-cores' => FILTER_VALIDATE_INT,
            'laptop-os' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'laptop-display-size' => $this->filterInputFloatArr,
            'laptop-price' => $this->filterInputFloatArr,
            'laptop-weight' => $this->filterInputFloatArr,
            'laptop-battery' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'laptop-camera' => FILTER_SANITIZE_SPECIAL_CHARS,
            'laptop-touchscreen' => FILTER_SANITIZE_SPECIAL_CHARS
        ];
    }

    public function monitorValidationFormInputs() {
        return [
            'monitor-qty' => $this->filterIntInputQty,
            'monitor-brand' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'monitor-price' => $this->filterInputFloatArr,
            'monitor-display-size' => $this->filterInputFloatArr,
            'monitor-weight' => $this->filterInputFloatArr
        ];
    }

    public function isFormSubmitted($method) {
        if($method == $_POST) {
            return ($_SERVER['REQUEST_METHOD'] == 'POST');
        } else {
            return ($_SERVER['REQUEST_METHOD'] == 'GET');
        }
    }
}
