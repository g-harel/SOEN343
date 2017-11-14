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

    /**
     * Used for validating desktop form
     * in PHP, adding and modifying function
     * can use this function
     * @return array
     */
    public function desktopValidationFormInputs()
    {
        return [
            'desktop-qty' => $this->filterIntInputQty,
            'desktop-brand' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'desktop-processor' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'desktop-ram-size' => FILTER_VALIDATE_INT,
            'desktop-storage-capacity' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'desktop-cpu-cores' => FILTER_VALIDATE_INT,
            'desktop-price' => $this->filterInputFloatArr,
            'desktop-weight' => $this->filterInputFloatArr,
            'desktop-height' => $this->filterInputFloatArr,
            'desktop-width' => $this->filterInputFloatArr,
            'desktop-thickness' => $this->filterInputFloatArr
        ];
    }

    /**
     * Used for validating laptop form
     * in PHP, adding and modifying function
     * can use this function
     * @return array
     */
    public function laptopValidationFormInputs()
    {
        return [
            'laptop-qty' => $this->filterIntInputQty,
            'laptop-brand' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'laptop-processor' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'laptop-ram-size' => FILTER_VALIDATE_INT,
            'laptop-storage-capacity' => FILTER_VALIDATE_INT,
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

    /**
     * Used for validating tablet form
     * in PHP, adding and modifying function
     * can use this function
     * @return array
     */
    public function tabletValidationFormInputs()
    {
        return $params = [
            'tablet-qty' => $this->filterIntInputQty,
            'tablet-brand' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'tablet-processor' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'tablet-ram-size' => FILTER_VALIDATE_INT,
            'tablet-cpu-cores' => FILTER_VALIDATE_INT,
            'tablet-os' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'tablet-storage-capacity' => FILTER_VALIDATE_INT,
            'tablet-display-size' => $this->filterInputFloatArr,
            'tablet-price' => $this->filterInputFloatArr,
            'tablet-weight' => $this->filterInputFloatArr,
            'tablet-height' => $this->filterInputFloatArr,
            'tablet-width' => $this->filterInputFloatArr,
            'tablet-thickness' => $this->filterInputFloatArr,
            'tablet-battery' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'tablet-camera' => FILTER_SANITIZE_SPECIAL_CHARS,
            'tablet-touchscreen' => FILTER_SANITIZE_SPECIAL_CHARS
        ];
    }

    public function registerValidateFormInputs()
    {
        $args = [
            'first_name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'last_name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'email' => FILTER_VALIDATE_EMAIL,
            'password' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'phone_number' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'door_number' => FILTER_VALIDATE_INT,
            'street' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'city' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'province' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'country' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'postal_code' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
        ];
        return $args;
    }

    /**
     * Used for validating monitor form
     * in PHP, adding and modifying function
     * can use this function
     * @return array
     */
    public function monitorValidationFormInputs()
    {
        return [
            'monitor-qty' => $this->filterIntInputQty,
            'monitor-brand' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'monitor-price' => $this->filterInputFloatArr,
            'monitor-display-size' => $this->filterInputFloatArr,
            'monitor-weight' => $this->filterInputFloatArr
        ];
    }

    public function isFormSubmitted($method)
    {
        if ($method == $_POST) {
            return ($_SERVER['REQUEST_METHOD'] == 'POST');
        } else {
            return ($_SERVER['REQUEST_METHOD'] == 'GET');
        }
    }

}
