<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2017-11-21
 * Time: 4:19 PM
 */

namespace App\Mappers;

use App\Models\SessionCatalog;
use App\Models\Session;
use App\Gateway\SessionGateway;
use App\IdentityMap\IdentityMap;
use App\UnitOfWork\UnitOfWork;


class SessionCatalogMapper
{
    private $sessionCatalog;
    private $gateway;
    private $identityMap;
    private $unitOfWork;
    private static $instance;

    private function __construct(){
        $this->sessionCatalog = new SessionCatalog();
        $this->gateway = new SessionGateway();
        $this->identityMap = IdentityMap::getInstance();
        $this->unitOfWork = UnitOfWork::getInstance();
    }

    public static function getInstance() {
        if (self::$instance === null){
            self::$instance = new SessionCatalogMapper();
        }
        return self::$instance;
    }

    public function openSession($accountId): bool {

    }

    public function closeSession($accountId): bool {

    }

    public function isSessionValid($sessionId): bool {

    }

    public function getSession($accountId) {

    }
}