<?php

namespace app\core\BaseModel;

use app\core\traits\HasCRUD;
use app\core\traits\HasAttribute;
use app\core\traits\HasQueryBuilder;
use app\core\traits\HasMethodCaller;

class Model {

    use HasQueryBuilder,HasCRUD,HasAttribute,HasMethodCaller;

    protected $fillable = [];
    protected $casts = [];
    protected $primaryKey = 'id';
    protected $created_at = 'created_at';
    protected $updated_at = 'updated_at';
    protected $collection = [];
    protected $table;


}