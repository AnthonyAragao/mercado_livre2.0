<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {
    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'usuarios';

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
        'created_at',
        'updated_at',
        'dadoAcessoRelationship',
    ];


    /**
     * The accessors to append to the model's arrays form
    * @var array
    */
    protected $appends = [
        'dado_acesso',
    ];

    // Getters e Setters
    public function getDadoAcessoAttribute(){
        return $this->dadoAcessoRelationship;
    }

    public function setDadoAcessoAttribute($value){
        $this->attributes['dados_acesso_id'] = DadoAcesso::where('id', $value)->first()->id;
    }

    // Relacionamentos
    public function dadoAcessoRelationship(){
        return $this->belongsTo(DadoAcesso::class, 'dados_acesso_id');
    }
}
