<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel panel-heading">
            <i class="{{ $config['icon'] }}"></i>
            {{ $config["title"] }}
        </div>
        <div class="panel panel-body">
            <table class='table table-striped table-bordered table-hover table-responsive'>
                <thead>
                    <th class="text-center">ID</th>
                    <th>Produto</th>
                    <th class="text-center">Qtd em Estoque</th>
                    <th class="text-center">Estoque Minimo</th>
                </thead>

                <tbody>
                @foreach($estoque as $e)
                    <tr>
                        <td>{{ $e->id }}</td>
                        <td>{{ $e->descricao }}</td>
                        <td class="text-right">{{ number_format($e->qtd, 0, "", ".") }}</td>
                        <td class="text-right">{{ number_format($e->estoque_minimo,0,"", ".") }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="panel panel-footer">
            {{ $estoque->links() }}
        </div>
    </div>
</div>
