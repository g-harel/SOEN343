<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //table name
    protected $table = 'items';
    //primary key
    public $primaryKey = 'id';
    //timestamps
    public $timestamps = true;
}
