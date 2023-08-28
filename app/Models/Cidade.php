<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model{
    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'cidades';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string
     */
    protected $guarded = [];

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
