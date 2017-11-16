<?php

namespace App\Mappers;

use App\Models\Cart;
use App\Gateway\unitGateway;
use App\UnitOfWork\UnitOfWork;
use App\IdentityMap\IdentityMap;

$deletedCart = array();

function mapId($id) {
    return "cart-$id";
}

class UnitMapper {
    private static $instance;
    private $unitGateway;
    private $identityMap;
    private $unitOfWork;

    private function __construct() {
        $this->unitGateway = UnitGateway::getInstance();
        $this->identityMap = IdentityMap::getInstance();
        $this->unitOfWork = UnitOfWork::getInstance();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new CartMapper();
        }
        return self::$instance;
    }

    // create a new cart.
    public function create() {
        // TODO uow
        return $this->unitGateway->addCart(null, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL');
    }

    // delete whole cart from database.
    public function delete($id) {
        // mark item in map as deleted.
        $this->identityMap->set(mapId($id), $deletedCart);
        // TODO uow
        $this->unitGateway->deleteCartById($id);
    }

    // fetches cart object from identity map or from the gateway.
    // returns null if the cart is not found.
    public function get($id) {
        $exists = $this->identityMap->hasId(mapId($id));
        if ($exists) {
            $cart = $this->identitiyMap->getObject($id);
            // deleted carts are set to this value so that reads
            // do not go fetch the value from the database (where
            // it still exists until work is committed)
            if ($cart === $deletedCart) {
                return null;
            }
            return $cart;
        }
        $cart = $this->unitGateway->getCartById($id);
        if ($cart === null) {
            return null;
        }
        // identity map is updated for future fetches.
        $this->identityMap->set(mapId($id), $cart);
        return $cart;
    }

    public function add($id, $itemId) {

    }

    public function remove($id, $itemId) {

    }

    public function checkout($id) {

    }
}