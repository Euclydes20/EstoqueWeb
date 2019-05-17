<?php

namespace WebEstoque\Widgets;

use Arrilot\Widgets\AbstractWidget;
use WebEstoque\Models\Products;

class WidgetProdutos extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'title' => 'Produtos',
        'icon' => 'ion ion-filing',
        'color' => 'bg-aqua',
        'route' => 'products.index'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $quantidade = Products::count();

        return view('widgets.widget_produtos', [
            'config' => $this->config,
            'quantidade' => $quantidade
        ]);
    }
}
