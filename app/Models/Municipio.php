<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model {
    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'municipios';

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
        'cidadeRelationShip'
    ];


    /**
     * The accessors to append to the model's arrays form
    * @var array
    */
    protected $appends = [
        'cidades'
    ];

    // Getters e Setters
    public function getCidadeAttribute(){
        return $this->cidadeRelationShip;
    }

    public function setCidadeAttribute($value){
        $this->attributes['cidade_id'] = Cidade::where('id', $value)->first()->id;
    }

    // Relacionamentos
    public function cidadeRelationShip(){
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }
}
