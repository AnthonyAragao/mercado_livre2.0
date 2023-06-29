<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DadoAcesso extends Model{
    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'dados_acesso';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email', 'cpf', 'password',
    ];

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
        return $this->enderecoRelationship();
    }

    public function setEnderecoAttribute($value){
        $this->attributes['endereco_id'] = Endereco::where('id', $value)->first()->id;
    }

    // Relacionamentos
    public function enderecoRelationship(){
        return $this->belongsTo(Endereco::class, 'endereco_id');
    }
}
