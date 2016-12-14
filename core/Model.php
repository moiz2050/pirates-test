<?php

namespace Core;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Model
 * @package Core
 */
class Model extends Eloquent
{

    //protected $db; //database connection object

    //protected $table; //table name

    //protected $fields = array();  //fields list

    /**
     * Model constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        Database::init();
        parent::__construct($attributes);

    }
    
}