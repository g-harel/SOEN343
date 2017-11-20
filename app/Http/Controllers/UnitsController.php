<?php 
namespace App\Http\Controllers;
use App\Mappers\UnitMapper;
use App\Mappers\AccountMapper;
use App\Mappers\ItemCatalogMapper;

class UnitsController extends Controller {
    
    public function showPurchase() {
        $units = UnitMapper::getInstance()->getPurchased($_SESSION['currentLoggedInId']);
        return view('pages.purchaseHistory', ['units' => $units ]);
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

    public function checkoutUnits(){
        $unitMapper = UnitMapper::getInstance();
        $units = $unitMapper->getCart($_SESSION['currentLoggedInId']);
        $itemMapper = ItemCatalogMapper::getInstance();
        $finalUnits = array();
        $specs = array();
        foreach ($units as $unit) {
            $item_specs = $itemMapper->getItem($unit['item_id']);
            array_push($specs, $item_specs);
        }
        foreach ($specs as $key => &$subArray) {
            $subArray += $units[$key];
            array_push($finalUnits, $subArray);
        }

        //    public function checkout($transactionId, $serial, $accountId, $purchasedPrice): bool {
        foreach($finalUnits as $unit){
            $unitMapper->checkout($_SESSION['session_id'], $unit['serial'],$unit['account_id'],$unit['price']);
            $unitMapper->commit($_SESSION['session_id']);
        }
        return view('pages.shoppingCart',[  'itemSuccessfullyPurchased' => true]);
    }
}
?>
