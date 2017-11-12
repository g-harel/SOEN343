<?php

namespace App\Http\Controllers;

use App\Mappers\ItemCatalogMapper;
use App\Gateway;
use App\Gateway\DesktopGateway;
use App\Gateway\TabletGateway;
use App\Gateway\LaptopGateway;


class ComputerController extends Controller
{

    public function index() {

    }

    public function showDesktop() {


        return view('items.computer.show-desktop', ['desktops' => ItemCatalogMapper::getInstance()->selectAllItemType(3)]);
    }

    public function showLaptop() {

        return view('items.computer.show-laptop', ['laptops' => ItemCatalogMapper::getInstance()->selectAllItemType(4)]);
    }

    public function showTablet() {

        return view('items.computer.show-tablet', ['tablets' => ItemCatalogMapper::getInstance()->selectAllItemType(5)]);
    }

    public function insertDesktop()
    {
        if($this->isFormSubmitted($_POST)) {

            $sanitizedInputs = filter_input_array(INPUT_POST, $this->desktopValidationFormInputs());
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return view('items.create', ['inputErrors' => $emptyArrayKeys, 'alertType' => 'warning']);
            } else {
                $desktopItem = [ // it is assumed all the values are good here, can now insert
                    "processor_type" => $sanitizedInputs["desktop-processor"],
                    "ram_size" => $sanitizedInputs["desktop-ram-size"],
                    "cpu_cores" => $sanitizedInputs["desktop-cpu-cores"],
                    "weight" => $sanitizedInputs["desktop-weight"],
                    "hdd_size" => $sanitizedInputs["storage-capacity"],
                    "category" => "desktop",
                    "brand" => $sanitizedInputs["computer-brand"],
                    "price" => $sanitizedInputs["desktop-price"],
                    "quantity" => $sanitizedInputs["desktop-qty"],
                    "height" => $sanitizedInputs["desktop-height"],
                    "width" => $sanitizedInputs["desktop-width"],
                    "thickness" => $sanitizedInputs["desktop-thickness"]
                ];
                $desktopGateway = new DesktopGateway();
                $desktopGateway->insert($desktopItem);
                return redirect()->back()->with(['succeedInsertingItem' => true, 'for' => 'desktop']);
            }
        } else {
            return view('items.create');
        }
    }

    public function insertLaptop()
    {
        if($this->isFormSubmitted($_POST)) {
            $sanitizedInputs = filter_input_array(INPUT_POST, $this->laptopValidationFormInputs());
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return view('items.create', ['inputErrors' => $emptyArrayKeys, 'alertType' => 'warning']);
            } else {
                $laptopItem = [
                    "processor_type" => $sanitizedInputs['laptop-processor'],
                    "ram_size" => $sanitizedInputs['laptop-ram-size'],
                    "cpu_cores" => $sanitizedInputs['laptop-cpu-cores'],
                    "weight" => $sanitizedInputs['laptop-weight'],
                    "hdd_size" => $sanitizedInputs["laptop-storage-capacity"],
                    "category" => "laptop",
                    "brand" => $sanitizedInputs['laptop-brand'],
                    "price" => $sanitizedInputs['laptop-price'],
                    "quantity" => $sanitizedInputs['laptop-qty'],
                    "display_size" => $sanitizedInputs['laptop-display-size'],
                    "os" => $sanitizedInputs['laptop-os'],
                    "battery" => $sanitizedInputs['laptop-battery'],
                    "camera" => $sanitizedInputs['laptop-camera'],
                    "is_touchscreen" => $sanitizedInputs['laptop-touchscreen'],
                ];
                $laptopGateway = new LaptopGateway();
                $laptopGateway->insert($laptopItem);
                return redirect()->back()->with(['succeedInsertingItem' => true, 'for' => 'laptop']);
            }
        } else {
            return view('items.create');
        }
    }

    public function insertTablet()
    {

        if($this->isFormSubmitted($_POST)) {
            $sanitizedInputs = filter_input_array(INPUT_POST, $this->tabletValidationFormInputs());
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return view('items.create', ['inputErrors' => $emptyArrayKeys, 'alertType' => 'warning']);
            } else {
                $tabletItem = [
                    "processor_type" => $sanitizedInputs['tablet-processor'],
                    "ram_size" => $sanitizedInputs['tablet-ram-size'],
                    "cpu_cores" => $sanitizedInputs['tablet-cpu-cores'],
                    "weight" => $sanitizedInputs['tablet-weight'],
                    "hdd_size" => $sanitizedInputs["tablet-storage-capacity"],
                    "category" => "tablet",
                    "brand" => $sanitizedInputs['tablet-brand'],
                    "price" => $sanitizedInputs['tablet-price'],
                    "quantity" => $sanitizedInputs['tablet-qty'],
                    "display_size" => $sanitizedInputs['tablet-display-size'],
                    "width" => $sanitizedInputs['tablet-width'],
                    "height" => $sanitizedInputs['tablet-height'],
                    "thickness" => $sanitizedInputs['tablet-thickness'],
                    "battery" => $sanitizedInputs['tablet-battery'],
                    "os" => $sanitizedInputs['tablet-os'],
                    "camera" => $sanitizedInputs['tablet-camera'],
                    "is_touchscreen" => $sanitizedInputs['tablet-touchscreen']
                ];
                $tabletGateWay = new TabletGateway();
                $tabletGateWay->insert($tabletItem);
                return redirect()->back()->with(['succeedInsertingItem' => true, 'for' => 'tablet']);
            }
        } else {
            return view('items.create');
        }
    }

    public function deleteDesktop()
    {
        // validate the id and the quantity in the modal
        $itemId = filter_input(INPUT_POST, 'item-id', FILTER_SANITIZE_SPECIAL_CHARS);
        $itemQty = filter_input(INPUT_POST, 'qty-to-remove', FILTER_VALIDATE_INT);
        $thisDesktop = Gateway\singleTableSelectUserQuery(["item_id" => $itemId], "desktops");
        if ($thisDesktop != null || !empty($thisDesktop)) {
            $newQty = null;
            $computer = Gateway\singleTableSelectUserQuery(["item_id" => $thisDesktop[0]["item_id"]], "computers");
            $item = Gateway\singleTableSelectUserQuery(["id" => $thisDesktop[0]["item_id"]], "items");
            if ($item[0]["id"] == $itemId) {
                $desktopUpdate = new DesktopGateway();
                // subtract the quantity entered with the old quantity
                $newQty = ($item[0]["quantity"] - $itemQty);
                // update function requires all fields to be present so
                $desktopItem = [
                    "id" => $item[0]["id"],
                    "processor_type" => $computer[0]["processor_type"],
                    "ram_size" => $computer[0]["ram_size"],
                    "cpu_cores" => $computer[0]["cpu_cores"],
                    "weight" => $computer[0]["weight"],
                    "type" => $computer[0]["type"],
                    "category" => $item[0]["category"],
                    "brand" => $item[0]["brand"],
                    "price" => $item[0]["price"],
                    "quantity" => $newQty,
                    "height" => $thisDesktop[0]["height"],
                    "width" => $thisDesktop[0]["width"],
                    "thickness" => $thisDesktop[0]["thickness"]
                ];
                $desktopUpdate->update($desktopItem);
                echo 'updated!';
            }
        } else {
            echo 'cannot update this item!';
        }
    }
}

