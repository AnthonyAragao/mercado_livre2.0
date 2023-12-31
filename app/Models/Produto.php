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

    protected $guarded = [];

    /**
     * The attributes that  should be hidden for arrays
    * @var array
    */
    protected $hidden = [
        'categoriaRelationship',
        'produtor_has_produtoRelationship',
        'avaliacaoRelantionShip'
    ];

    /**
     * The accessors to append to the model's arrays form
    * @var array
    */
    protected $appends = [
        'categorias',
        'produtor_has_produto',
        'avaliacao'
    ];

    // Getters e Setters
    public function getCategoriaAttribute(){
        return $this->categoriaRelationship;
    }

    public function getProdutorHasProdutoAttribute(){
        return $this->produtor_has_produtoRelationship;
    }

    public function getAvaliacaoAttribute(){
        return $this->avaliacaoRelantionShip;
    }


    public function setCategoriaAttribute($value){
        if(isset($value)){
            $this->attributes['categoria_id'] = Categoria::where('id', $value)->first()->id;
        }
    }

    public function setAvaliacaoAttribute($value){
        if (isset($value)) {
            $this->attributes['produto_id'] = Avaliacao::where(
                'id',
                $value
            )->first()->id;
        }
    }

    // Relacionamentos
    public function categoriaRelationship(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function produtor_has_produtoRelationship(){
        return $this->hasMany(Produtor_has_produto::class, 'produto_id');
    }

    public function avaliacaoRelantionShip(){
        return $this->hasMany(Avaliacao::class, 'produto_id');
    }
}
