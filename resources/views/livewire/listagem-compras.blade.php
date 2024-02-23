<div>
    @foreach ($compras as $compra)
        <div class="shopping">
            <div class="date">
                <p>
                    <?php
                        $meses = array(
                            'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                        );

                        $timestamp = strtotime($compra->data);
                        $dia = date("j", $timestamp);
                        $mes = $meses[date("n", $timestamp) - 1];

                        echo $dia . " de " . $mes;
                    ?>
                </p>
            </div>

            <div class="details">
                <div class="details-img">
                    <div>
                        <img src="{{ asset('files/produtos')}}/{{$compra->exemplar[0]->pivo->produto->imagem_01}}" class="max-w-none">
                    </div>

                    <span>{{$compra->exemplar[0]->pivo->produto->nome}}</span>
                </div>

                <div class="details-producer">
                    <span><?= strtoupper($compra->exemplar[0]->pivo->produtor->dados_empresa->nome); ?></span>

                    <a href="">Enviar mensagem</a>
                </div>

                <div class="container-btns">
                    <a href="{{route('pedido.show', [Crypt::encrypt($compra->id)]) }}">
                        <button class="btn" style="background-color: #3783f7; color: white; width: 100%;">
                            Ver compra
                        </button>
                    </a>

                    @if (count($compra->avaliacao) === 0)
                        <a href="{{route('reviews.create', [Crypt::encrypt($compra->id)] )}}" class="btn" style="width: 100%; background-color:rgba(65,137,230,.15); color: #3483fa">
                            Opinar
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    <div class="py-4 mb-16">
        {{ $compras->links() }}
    </div>
</div>
