<?php 
namespace App\Http\Controllers;
use App\Mappers\UnitMapper;
use App\Mappers\AccountMapper;
class UnitsController extends Controller {
    public function showPurchase() {
        $units = UnitMapper::getInstance()->getPurchased($_SESSION['currentLoggedInId']);
        return view('pages.purchaseHistory', ['units' => $units ]);
        /*return view('purchaseHistory', ['units' => UnitMapper::getPurchased($_SESSION['currentLoggedInId']), 
                                       'returns' => UnitMapper::getReturned($_SESSION['currentLoggedInId']]);*/
    }
    public function returnPurchase() {
        if($this->isFormSubmitted($_POST)) {
            $transId = filter_input(INPUT_POST, 'transaction-id', FILTER_SANITIZE_SPECIAL_CHARS);
            $serialNb = filter_input(INPUT_POST, 'serial-nb', FILTER_SANITIZE_SPECIAL_CHARS);
            $unitMapper = UnitMapper::getInstance();
            $unitMapper->return($transId, $serialNb);
            $unitMapper->commit($transId);
            return view('pages.purchaseHistory',['itemSuccessfullyReturned' => true]);
        }
        return view('pages.purchaseHistory');
    }
}
?>