<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtor extends Model{
    use HasFactory;

    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'produtores';

    /**
     * The attributes that  should be hidden for arrays
    * @var array
    */
    protected $hidden = [


    ];


    /**
     * The accessors to append to the model's arrays form
    * @var array
    */
    protected $appends = [


    ];
}
