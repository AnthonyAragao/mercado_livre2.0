<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mora extends Model
{
     /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'mora';

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
    public function getEnderecoAttribute(){
        return $this->enderecoRelationship;
    }

    public function getDadoAcessoAttribute(){
        return $this->dadoAcessoRelationship;
    }

    public function setDadoAcessoAttribute($value){
        $this->attributes['dados_acesso_id'] = DadoAcesso::where('id', $value)->first()->id;
    }

    public function setEnderecoAttribute($value){
        $this->attributes['endereco_id'] = Endereco::where('id', $value)->first()->id;
    }


    // Relacionamentos
    public function enderecoRelationship(){
        return $this->belongsTo(Endereco::class, 'endereco_id');
    }

    public function dadoAcessoRelationship(){
        return $this->belongsTo(DadoAcesso::class, 'mora_id');
    }
}
