<?php 
namespace App\Http\Controllers;

use App\Mappers\UnitMapper;
use App\Mappers\AccountMapper;

class UnitsController extends Controllers {

    public function showPurchase(){
        return view('pages.purchaseHistory', ['units' => UnitMapper::getPurchased($_SESSION['currentLoggedInId'])]);
        /*return view('purchaseHistory', ['units' => UnitMapper::getPurchased($_SESSION['currentLoggedInId']), 
                                       'returns' => UnitMapper::getReturned($_SESSION['currentLoggedInId']]);*/
    }

    public function returnPurchase(){  
         if($this->isFormSubmitted($_POST)) {
            $transId = filter_input(INPUT_POST, 'transaction-id', FILTER_SANITIZE_SPECIAL_CHARS);
            $serialNb = filter_input(INPUT_POST, 'serial-nb', FILTER_SANITIZE_SPECIAL_CHARS);
            if(!empty($transId) && !empty($serial)) {
                $unitMapper = UnitMapper::return($transId, $serialNb);
                //return redirect()->back()->with(['itemSuccessfullyDeleted' => true]);
            } else {
                return view('pages.purchaseHistory');
            }
        }
        return view('pages.purchaseHistory');
    }
}
?>