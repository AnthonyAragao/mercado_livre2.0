<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Compra;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ListagemCompras extends Component
{
    use WithPagination;

    public function render()
    {
        $compras = Compra::where('usuario_id', Auth::user()->usuario[0]->id )
            ->with([
                'exemplarRelationShip.pivoRelationShip.produtorRelationship.dadoEmpresaRelationship',
                'exemplarRelationShip.pivoRelationShip.produtoRelationship',
                'avaliacaoRelationShip'
                ])
            ->paginate(5);

        return view('livewire.listagem-compras', ['compras' => $compras]);
    }
}
