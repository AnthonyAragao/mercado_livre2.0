<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model{
    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'compras';

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
    protected $hidden = [];


    /**
     * The accessors to append to the model's arrays form
    * @var array
    */
    protected $appends = [];

    // Getters e Setters
    public function getUsuarioAttribute(){
        return $this->usuarioRelationShip;
    }

    public function getExemplarAttribute(){
        return $this->exemplarRelationShip;
    }

    public function getAvaliacaoAttribute(){
        return $this->avaliacaoRelationShip;
    }


    public function setUsuarioAttribute($value){
        $this->attributes['usuario_id'] = Usuario::where('id', $value)->first()->id;
    }

    public function setExemplarAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['dados_acesso_id'] = Exemplar::where(
                'id',
                $value
            )->first()->id;
        }
    }

    public function setAvaliacaoAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['compra_id'] = Avaliacao::where(
                'id',
                $value
            )->first()->id;
        }
    }

    // relacionamentos
    public function usuarioRelationShip(){
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function exemplarRelationShip(){
        return $this->hasMany(Exemplar::class, 'compra_id');
    }

    public function avaliacaoRelationShip(){
        return $this->hasMany(Avaliacao::class, 'compra_id');
    }
}
