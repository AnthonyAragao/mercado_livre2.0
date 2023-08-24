<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'produtos';

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
        'categoriaRelationship'
    ];


    /**
     * The accessors to append to the model's arrays form
    * @var array
    */
    protected $appends = [
        'categorias'
    ];

    // Getters e Setters
    public function getCategoriaAttribute(){
        return $this->categoriaRelationship;
    }

    public function setCategoriaAttribute($value){
        if(isset($value)){
            $this->attributes['categoria_id'] = Categoria::where('id', $value)->first()->id;
        }
    }

    // Relacionamentos
    public function categoriaRelationship(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
