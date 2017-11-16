<?php 
namespace App\Http\Controllers;

use App\Mappers\UnitMapper;
use App\Mappers\AccountMapper;

class UnitsController extends Controllers {

    public function showPurchase(){
        return view('purchaseHistory', ['units' => UnitMapper::getPurchased(getId())]);
    }

    public function returnPurchase(){

    }
}
?>