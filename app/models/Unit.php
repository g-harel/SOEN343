<?php

namespace App\Models;

class Unit {
    private $serial;
    private $itemId;
    private $accountId;
    private $status;
    private $reservedDate;
    private $purchasedPrice;
    private $purchasedDate;

    public function __construct($serial, $itemId, $accountId, $status, $reservedDate, $purchasedPrice, $purchasedDate) {
        $this->$serial = $serial;
        $this->$itemId = $itemId;
        $this->$accountId = $accountId;
        $this->$status = $status;
        $this->$reservedDate = $reservedDate;
        $this->$purchasedPrice = $purchasedPrice;
        $this->$purchasedDate = $purchasedDate;
    }

    public function getSerial() {
        return $this->serial;
    }

    public function getItemId() {
        return $this->itemId;
    }

    public function getAccountId() {
        return $this->accountId;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getReservedDate() {
        return $this->reservedDate;
    }

    public function getPurchasedPrice() {
        return $this->purchasedPrice;
    }

    public function getPurchasedDate() {
        return $this->purchasedDate;
    }

    public function setSerial($serial) {
        $this->serial = $serial;
    }

    public function setItemId($itemId) {
        $this->itemId = $itemId;
    }

    public function setAccountId($accountId) {
        $this->accountId = $accountId;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setReservedDate($reservedDate) {
        $this->reservedDate = $reservedDate;
    }

    public function setPurchasedPrice($purchasedPrice) {
        $this->purchasedPrice = $purchasedPrice;
    }

    public function setPurchasedDate($purchasedDate) {
        $this->purchasedDate = $purchasedDate;
    }
}
