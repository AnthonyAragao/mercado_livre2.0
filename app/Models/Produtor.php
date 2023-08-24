<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtor extends Model{
    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'produtores';

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
        'dadoEmpresaRelationship',
        'dadoAcessoRelationship'
    ];


    /**
     * The accessors to append to the model's arrays form
    * @var array
    */
    protected $appends = [

    ];
     // Getters e Setters
     public function getDadoAcessoAttribute(){
        return $this->dadoAcessoRelationship;
    }

    public function getDadosEmpresaAttribute(){
        return $this->dadoEmpresaRelationship;
    }

    public function getProdutoAttribute(){
        return $this->produtoRelationship;
    }

    public function setProdutoAttribute($value){
        $this->produtoRelationship()->sync($value);
    }

    public function setDadoAcessoAttribute($value){
        $this->attributes['dados_acesso_id'] = DadoAcesso::where('id', $value)->first()->id;
    }


    public function setDadoEmpresaAttribute($value){
        $this->attributes['dados_empresa_id'] = DadoEmpresa::where('id', $value)->first()->id;
    }

    // Relacionamentos
    public function dadoAcessoRelationship(){
        return $this->belongsTo(DadoAcesso::class, 'dados_acesso_id');
    }

    public function dadoEmpresaRelationship(){
        return $this->belongsTo(DadoEmpresa::class, 'dados_empresa_id');
    }

    public function produtoRelationship(){
        return $this->belongsToMany(Produto::class, 'produtor_has_produto', 'produto_id', 'produtor_id');
    }
}
