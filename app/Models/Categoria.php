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

    // Getters e Setters
    public function getProdutoAttribute(){
        return $this->produtoRelationship;
    }

    public function setProdutoAttribute($value){
        if(isset($value)){
            $this->attributes['produto_id'] = Produto::where('id', $value)->first()->id;
        }
    }

    // Relacionamentos
    public function produtoRelationship(){
        return $this->hasMany(Produto::class, 'categoria_id');
    }
}
