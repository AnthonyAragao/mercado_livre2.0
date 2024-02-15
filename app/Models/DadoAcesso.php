<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class DadoAcesso extends Authenticatable{
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
        'nome', 'email', 'cpf', 'password', 'telefone', 'nascimento', 'mora_id'
    ];

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
    // public function getEnderecoAttribute(){
    //     return $this->enderecoRelationship;
    // }

    public function getProdutorAttribute(){
        return $this->produtorRelationship;
    }

    public function getUsuarioAttribute(){
        return $this->UsuarioRelationship;
    }

    public function getMoraAttribute(){
        return $this->MoraRelationship;
    }


    public function setUsuarioAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['dados_acesso_id'] = Usuario::where(
                'id',
                $value
            )->first()->id;
        }
    }

    public function setProdutorAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['dados_acesso_id'] = Produtor::where(
                'id',
                $value
            )->first()->id;
        }
    }

    public function setEnderecoAttribute($value){
        $this->attributes['mora_id'] = Mora::where('id', $value)->first()->id;
    }


    // String de endereço formatada
    public function printEndereco(){
        return explode(' ', Auth::user()->nome)[0] . ' - ' . Auth::user()->mora->endereco->municipio->nome . ' - ' . Auth::user()->mora->endereco->cep;
    }

    // Relacionamentos
    public function moraRelationship(){
        return $this->belongsTo(Mora::class, 'mora_id');
    }

    public function produtorRelationship(){
        return $this->hasMany(Produtor::class, 'dados_acesso_id');
    }

    public function usuarioRelationship(){
        return $this->hasMany(Usuario::class, 'dados_acesso_id');
    }
}
