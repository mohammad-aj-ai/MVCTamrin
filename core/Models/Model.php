<?php

namespace app\core\Model;

use app\traits\CRUD;
use app\traits\HasAttribute;
use app\traits\QueryBuilder;

class Model {

    use QueryBuilder,CRUD,HasAttribute;

    protected $fillable = [];
    protected $casts = [];
    protected $primaryKey = 'id';
    protected $created_at = 'created_at';
    protected $updated_at = 'updated_at';
    protected $collection = [];
    protected $table;


}