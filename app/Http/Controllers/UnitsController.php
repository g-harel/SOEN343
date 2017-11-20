<?php 
namespace App\Http\Controllers;
use App\Mappers\UnitMapper;
use App\Mappers\AccountMapper;
class UnitsController extends Controller {
    
    public function showPurchase() {
        $units = UnitMapper::getInstance()->getPurchased($_SESSION['currentLoggedInId']);
        return view('pages.purchaseHistory', ['units' => $units ]);
    }

    public function returnPurchase() {
        $units = UnitMapper::getInstance()->getPurchased($_SESSION['currentLoggedInId']);
        if($this->isFormSubmitted($_POST)) {
            $transId = filter_input(INPUT_POST, 'transaction-id', FILTER_SANITIZE_SPECIAL_CHARS);
            $serialNb = filter_input(INPUT_POST, 'serial-nb', FILTER_SANITIZE_SPECIAL_CHARS);
            $unitMapper = UnitMapper::getInstance();
            $unitMapper->return($transId, $serialNb);
            $unitMapper->commit($transId);
            if(isset($_POST['remove-from-cart'])) {
                return redirect()->back()->with([
                    'itemSuccessfullyRemoved' => true
                ]);
            } else {
                return view('pages.purchaseHistory', [
                    'itemSuccessfullyReturned' => true]
                );
            }
        }
        return view('pages.purchaseHistory', [
            'units' => $units,
            'itemSuccessfullyReturned' => true]
        );
    }
}
?>
