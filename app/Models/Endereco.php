<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model{
    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'enderecos';

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
    protected $hidden = [


    ];


    /**
     * The accessors to append to the model's arrays form
    * @var array
    */
    protected $appends = [


    ];

    // Getters e Setters
    public function getMunicipioAttribute(){
        return $this->municipioRelationShip;
    }

    public function setMunicipioAttribute($value){
        $this->attributes['municipio_id'] = Municipio::where('id', $value)->first()->id;
    }

    // relacionamentos
    public function municipioRelationShip(){
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }

    public function moraRelationship(){
        return $this->hasMany(Mora::class, 'endereco_id');
    }
}
