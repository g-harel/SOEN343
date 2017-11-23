<?php

namespace App\Mappers;

use App\Models\SessionCatalog;
use App\Models\Session;
use App\Gateway\SessionGateway;
use App\IdentityMap\IdentityMap;
use App\UnitOfWork\UnitOfWork;
use App\UnitOfWork\CollectionMapper;


class SessionCatalogMapper implements CollectionMapper
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

    public static function getInstance(): SessionCatalogMapper {
        if (self::$instance === null){
            self::$instance = new SessionCatalogMapper();
        }
        return self::$instance;
    }

    public function openSession($accountId): bool {
        // THIS LINE BREAKS THE PATTERN OF HAVING USED OBJECTS IN MEMORY SINCE IT ALWAYS FETCHES FROM DB.
        // THIS IS BECAUSE OUR APP IS A SERVER RENDERED PAGE AND MEMORY ISN'T SHARED BETWEEN TABS / USERS
        // THIS MEANS THAT IF USER 1 OPENS A NEW SESSION IN A SECOND TAB, THE MEMORY RELATED TO TAB 1 WON'T KNOW.
        // THIS MEANS THAT THE ONLY REAL COCONCURRENCY PROTECTION WE CAN HAVE COMES FROM THE DATABASE
        // THIS LINE IS HERE TO ASSURE OURSELVES THAT THE APP IS SYNCHRONIZED. PLEASE IGNORE IT IN VIEW OF THE DESIGN PATTERNS!
        $this->synchronizeAccountSession($accountId);

        $mapSessionId = $this->getIdentityMapId($accountId);
        $sessionAlreadyExists = $this->identityMap->hasId($mapSessionId);
        $wasNewSessionOpened = true;
        if ($sessionAlreadyExists) {
            $wasNewSessionOpened = false;
        } else {
            $sessionId = $this->gateway->addSession($accountId);
            if ($sessionId === null) {
                $wasNewSessionOpened = false;
            } else {
                $sessionArray = $this->gateway->getSessionById($sessionId);
                $this->addSessionToCatalogAndMap($sessionArray);
            }

        }
        return $wasNewSessionOpened;
    }

    public function closeSession($accountId, $sessionId): bool {
        // THIS LINE BREAKS THE PATTERN OF HAVING USED OBJECTS IN MEMORY SINCE IT ALWAYS FETCHES FROM DB.
        // THIS IS BECAUSE OUR APP IS A SERVER RENDERED PAGE AND MEMORY ISN'T SHARED BETWEEN TABS / USERS
        // THIS MEANS THAT IF USER 1 OPENS A NEW SESSION IN A SECOND TAB, THE MEMORY RELATED TO TAB 1 WON'T KNOW.
        // THIS MEANS THAT THE ONLY REAL COCONCURRENCY PROTECTION WE CAN HAVE COMES FROM THE DATABASE
        // THIS LINE IS HERE TO ASSURE OURSELVES THAT THE APP IS SYNCHRONIZED. PLEASE IGNORE IT IN VIEW OF THE DESIGN PATTERNS!
        $this->synchronizeAccountSession($accountId);

        $isSessionClosing = false;
        $isSessionValid = $this->sessionCatalog->isAccountSessionValid($accountId, $sessionId);

        if ($isSessionValid) {
            $uoWobjectId = $this->getIdentityMapId($sessionId);
            $session = $this->sessionCatalog->getSession($accountId);
            $this->unitOfWork->registerDeleted($sessionId, $uoWobjectId, self::$instance, $session);
            $isSessionClosing = true;
        }
        return $isSessionClosing;
    }

    public function commit($sessionId) {
        $this->unitOfWork->commit($sessionId);
    }

    public function getSession($accountId) {
        // THIS LINE BREAKS THE PATTERN OF HAVING USED OBJECTS IN MEMORY SINCE IT ALWAYS FETCHES FROM DB.
        // THIS IS BECAUSE OUR APP IS A SERVER RENDERED PAGE AND MEMORY ISN'T SHARED BETWEEN TABS / USERS
        // THIS MEANS THAT IF USER 1 OPENS A NEW SESSION IN A SECOND TAB, THE MEMORY RELATED TO TAB 1 WON'T KNOW.
        // THIS MEANS THAT THE ONLY REAL COCONCURRENCY PROTECTION WE CAN HAVE COMES FROM THE DATABASE
        // THIS LINE IS HERE TO ASSURE OURSELVES THAT THE APP IS SYNCHRONIZED. PLEASE IGNORE IT IN VIEW OF THE DESIGN PATTERNS!
        $this->synchronizeAccountSession($accountId);

        $session = $this->sessionCatalog->getSession($accountId);
        $sessionExists = $session !== null;

        if ($sessionExists) {
            return [
                "id" => $session->getId(),
                "accountId" => $session->getAccountId(),
                "loginTime" => $session->getLoginTime(),
            ];
        } else {
            return null;
        }

    }

    // UoW Interface methods
    public function add($object) {
        // NOT USED
    }

    // UoW Interface methods
    public function edit($object) {
        // NOT USED
    }

    // UoW Interface methods
    public function delete($session) {
        echo "IN DELETE METHOD!!";
        $accountId = $session->getAccountId();
        $this->gateway->deleteSessionByAccountId($accountId);
        $this->removeSessionFromCatalogAndMap($accountId);
    }

    // CREATED FOR UNIT OF WORK VALID SESSION VERIFICATION
    public function doesSessionExists($sessionId): bool {
        // THIS LINE BREAKS THE PATTERN OF HAVING USED OBJECTS IN MEMORY SINCE IT ALWAYS FETCHES FROM DB.
        // THIS IS BECAUSE OUR APP IS A SERVER RENDERED PAGE AND MEMORY ISN'T SHARED BETWEEN TABS / USERS
        // THIS MEANS THAT IF USER 1 OPENS A NEW SESSION IN A SECOND TAB, THE MEMORY RELATED TO TAB 1 WON'T KNOW.
        // THIS MEANS THAT THE ONLY REAL COCONCURRENCY PROTECTION WE CAN HAVE COMES FROM THE DATABASE
        // THIS LINE IS HERE TO ASSURE OURSELVES THAT THE APP IS SYNCHRONIZED. PLEASE IGNORE IT IN VIEW OF THE DESIGN PATTERNS!
        $this->synchronizeSessionId($sessionId);
        return $this->sessionCatalog->isSessionValid($sessionId);
    }

    // CREATED FOR THE CONTROLLERS TO CHECK VALIDITY OF ONGOING SESSIONS BEFORE PUSHING CHANGES TO STORAGE
    public function isAccountSessionValid($accountId, $sessionId): bool {
        $this->synchronizeAccountSession($accountId);
        $isValidInMemory = $this->sessionCatalog->isAccountSessionValid($accountId, $sessionId);
        return $isValidInMemory;
    }

    // Used to avoid collisions in UoW and IdentityMap
    private function getIdentityMapId($id): string {
        return "session" . $id;
    }

    // This method creates a session object directly but the object is never used directly to populate the IdentityMap
    // or the session catalog directly. The object serves to make it more convenient to manipulate the datafields
    // within the array
    private function convertStorageArrayToSession($storageArray): Session {
        $associativeArray = $storageArray[0];
        $id = $associativeArray["id"];
        $accountId = $associativeArray["account_id"];
        $timestamp = $associativeArray["login_time_stamp"];
        return new Session($id, $accountId, $timestamp);
    }

    private function addSessionToCatalogAndMap($sessionArrayFromStorage) {
        $storageSession = $this->convertStorageArrayToSession($sessionArrayFromStorage);
        $accountId = $storageSession->getAccountId();
        // Synchronizing the catalog to what the storage has.
        $sessionInCatalog = $this->sessionCatalog->getSession($accountId);
        $doesSessionExistsInCatalog = $sessionInCatalog !== null;
        $sameSessionInCatalog = false;
        if ($doesSessionExistsInCatalog) {
            $sameSessionInCatalog = $sessionInCatalog->equals($storageSession);

        }

        if ($sameSessionInCatalog === false || $doesSessionExistsInCatalog === false) {
            // This recreates a new object --> different memory address for new object
            $this->sessionCatalog->addSession($storageSession->getId(), $storageSession->getAccountId(),
                $storageSession->getLoginTime());
            $sessionInCatalog = $this->sessionCatalog->getSession($accountId);
        }

        $mapSessionId = $this->getIdentityMapId($accountId);
        // Synchronizing the IdentityMap to what the storage has.
        if ($this->identityMap->hasId($mapSessionId)) {
            $sessionInMap = $this->identityMap->getObject($mapSessionId);
            $sameSessionInMap = $sessionInMap->equals($storageSession);
            if ($sameSessionInMap === false) {
                // Here we set the same object from the catalog into the identityMap
                $this->identityMap->set($mapSessionId, $sessionInCatalog);
            }

        } else {
            // If the identitymap doesn't have any session object, we set it up here with the same memory address
            // as the object in catalog.

            // Here we set the same object from the catalog into the identityMap
            $this->identityMap->set($mapSessionId, $sessionInCatalog);
        }
    }

    private function removeSessionFromCatalogAndMap($accountId) {
        $mapSessionId = $this->getIdentityMapId($accountId);
        $this->sessionCatalog->clearAccountSession($accountId);
        $sessionExistsInMap = $this->identityMap->hasId($mapSessionId);
        if ($sessionExistsInMap) {
            $this->identityMap->removeObject($mapSessionId);
        }
    }

    private function synchronizeAccountSession($accountId): void {
        $storageSessionArray = $this->gateway->getSessionByAccountId($accountId);

        $sessionExists = $storageSessionArray !== null;
        if ($sessionExists) {
            $this->addSessionToCatalogAndMap($storageSessionArray);
        } else {
            $this->removeSessionFromCatalogAndMap($accountId);
        }
    }

    private function synchronizeSessionId($sessionId): void {
        $storageSessionArray = $this->gateway->getSessionById($sessionId);
        $sessionExists = $storageSessionArray !== null;
        if ($sessionExists) {
            $this->addSessionToCatalogAndMap($storageSessionArray);
        } else {
            $this->sessionCatalog->removeSession($sessionId);
        }
    }
}