<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model{
    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'categorias';


    /**
     * The attributes that  should be hidden for arrays
    * @var array
    */
    protected $hidden = [];


    /**
     * The accessors to append to the model's arrays form
    * @var array
    */
    protected $appends = [];

}
