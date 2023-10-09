<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model{
     /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'avaliacoes';

    /**
     * The attributes that  should be hidden for arrays
    * @var array
    */
    protected $hidden = [];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string
     */
    protected $guarded = [];

    /**
     * The accessors to append to the model's arrays form
    * @var array
    */
    protected $appends = [];


    // Getters e Setters
    public function getCompraAttribute(){
        return $this->compraRelationship;
    }

    public function getProdutoAttribute(){
        return $this->produtoRelationship;
    }

    public function getUsuarioAttribute(){
        return $this->usuarioRelationship;
    }

    public function setCompraAttribute($value){
        if(isset($value)){
            $this->attributes['compra_id'] = Avaliacao::where('id', $value)->first()->id;
        }
    }

    public function setProdutoAttribute($value){
        if(isset($value)){
            $this->attributes['produto_id'] = Avaliacao::where('id', $value)->first()->id;
        }
    }

    public function setUsuarioAttribute($value){
        if(isset($value)){
            $this->attributes['usuario_id'] = Avaliacao::where('id', $value)->first()->id;
        }
    }

    // Relacionamentos
    public function compraRelationship(){
        return $this->belongsTo(Compra::class, 'compra_id');
    }

    public function produtoRelationship(){
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function usuarioRelationship(){
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

}
