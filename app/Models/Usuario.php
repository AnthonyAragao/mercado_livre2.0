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
        'avaliacaoRelationShip',
        'compraRelationShip'
    ];


    /**
     * The accessors to append to the model's arrays form
    * @var array
    */
    protected $appends = [
        'dado_acesso',
        'compras',
        'avaliacoes'
    ];

    // Getters e Setters
    public function getDadoAcessoAttribute(){
        return $this->dadoAcessoRelationship;
    }

    public function getCompraAttribute(){
        return $this->compraRelationShip;
    }

    public function getAvaliacaoAttribute(){
        return $this->avaliacaoRelationShip;
    }

    public function setDadoAcessoAttribute($value){
        $this->attributes['dados_acesso_id'] = DadoAcesso::where('id', $value)->first()->id;
    }

    public function setCompraAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['usuario_id'] = Compra::where(
                'id',
                $value
            )->first()->id;
        }
    }

    public function setAvaliacaoAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['usuario_id'] = Avaliacao::where(
                'id',
                $value
            )->first()->id;
        }
    }
    // Relacionamentos
    public function dadoAcessoRelationship(){
        return $this->belongsTo(DadoAcesso::class, 'dados_acesso_id');
    }

    public function compraRelationShip(){
        return $this->hasMany(Compra::class, 'usuario_id');
    }

    public function avaliacaoRelationShip(){
        return $this->hasMany(Avaliacao::class, 'usuario_id');
    }
}
