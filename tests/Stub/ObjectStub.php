<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2017-11-19
 * Time: 6:34 PM
 */

namespace Tests\Stub;


class ObjectStub
{
    private $id;

    public function __construct($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
}