<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exemplar extends Model{
    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'exemplares';

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
    public function getPivoAttribute(){
        return $this->pivoRelationShip;
    }

    public function getCompraAttribute(){
        return $this->compraRelationShip;
    }


    public function setUsuarioAttribute($value){
        $this->attributes['pivo_id'] = Produtor_has_produto::where('id', $value)->first()->id;
    }

    public function setCompraAttribute($value){
        $this->attributes['compra_id'] = Compra::where('id', $value)->first()->id;
    }

    // relacionamentos
    public function pivoRelationShip(){
        return $this->belongsTo(Produtor_has_produto::class, 'pivo_id');
    }

    public function compraRelationShip(){
        return $this->belongsTo(Compra::class, 'compra_id');
    }
}
