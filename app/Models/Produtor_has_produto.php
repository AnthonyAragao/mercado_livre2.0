<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtor_has_produto extends Model{
    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'produtor_has_produto';

    protected $guarded = [];

    /**
     * The attributes that  should be hidden for arrays
    * @var array
    */
    protected $hidden = [
        'produtoRelationship',
        'produtorRelationship'
    ];

    /**
     * The accessors to append to the model's arrays form
    * @var array
    */
    protected $appends = [
        'produto',
        'produtor'
    ];

    // Getters e Setters
    public function getProdutoAttribute(){
        return $this->produtoRelationship;
    }

    public function getProdutorAttribute(){
        return $this->produtorRelationship;
    }

    public function getExemplarAttribute(){
        return $this->exemplarRelationShip;
    }

    public function setProdutorAttribute($value){
        if(isset($value)){
            $this->attributes['produtor_id'] = Produtor::where('id', $value)->first()->id;
        }
    }

    public function setProdutoAttribute($value){
        if(isset($value)){
            $this->attributes['produto_id'] = Produto::where('id', $value)->first()->id;
        }
    }

    public function setExemplaAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['pivo_id'] = Exemplar::where(
                'id',
                $value
            )->first()->id;
        }
    }

    // Relacionamentos
    public function produtoRelationship(){
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function produtorRelationship(){
        return $this->belongsTo(Produtor::class, 'produtor_id');
    }

    public function exemplarRelationShip(){
        return $this->hasMany(Exemplar::class, 'pivo_id');
    }
}
