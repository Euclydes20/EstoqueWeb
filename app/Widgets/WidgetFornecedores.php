<?php

namespace WebEstoque\Widgets;

use Arrilot\Widgets\AbstractWidget;
use WebEstoque\Models\Providers;

class WidgetFornecedores extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'title' => 'Fornecedores',
        'icon' => 'ion ion-person-stalker',
        'color' => 'bg-green',
        'route' => 'providers.index'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $quantidade = Providers::count();

        return view('widgets.widget_fornecedores', [
            'config' => $this->config,
            'quantidade' => $quantidade
        ]);
    }
}
