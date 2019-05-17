<?php

namespace WebEstoque\Widgets;

use Arrilot\Widgets\AbstractWidget;
use WebEstoque\Models\Products;
use DB;

class WidgetEstoqueMinimo extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'title' => 'Relação de produtos que estão com estoque abaixo do mínimo',
        'icon' => 'fa fa-table'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $estoque = Products::whereRaw('qtd <= estoque_minimo')->paginate(5);

        return view('widgets.widget_estoque_minimo', [
            'config' => $this->config,
            'estoque' => $estoque
        ]);
    }
}
