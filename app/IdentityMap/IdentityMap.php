<?php 

namespace App\IdentityMap;
use ArrayObject;
use SplObjectStorage;

class IdentityMap
{
    protected $idToObject;
    protected $objectToId;
    private static $instance;

    /*
     * The SplObjectStorage class provides a map from objects to data or, by ignoring data, 
     * an object set. This dual purpose can be useful in many cases involving the need to
     * uniquely identify objects.
     * 
     * The ArrayObject class allows objects to work as arrays.
     * 
     */
    
    private function __construct()
    {
        $this->idToObject = new ArrayObject();
        $this->objectToId = new SplObjectStorage();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new IdentityMap();
        }
        return self::$instance;
    }

    public function set($id, $object)
    {
        $this->idToObject[$id] = $object;
        $this->objectToId[$object] = $id;
    }

    public function getId($object)
    {
        if (false === $this->hasObject($object)){
            throw new OutOfBoundsException();
        }
        return $this->objectToId[$object];
    }

    public function hasId($id)
    {
        return isset($this->idToObject[$id]);
    }

    public function hasObject($object)
    {
        return isset($this->objectToId[$object]);
    }

    public function getObject($id)
    {
        if (false === $this->hasId($id)){
            throw new OutOfBoudsException();
        }
        return $this->idToObject[$id];
    }

    public function removeObject($id)
    {
        if (false === $this->hasId($id)){
            throw new OutOfBoundsException();
        }
        $object = $this->getObject($id);
        unset($this->idToObject[$id]);
        unset($this->objectToId[$object]);
    }
}
?>
