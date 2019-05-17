<?php

namespace WebEstoque\Widgets;

use Arrilot\Widgets\AbstractWidget;
use WebEstoque\Models\Classifications;

class WidgetClassificacoes extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'title' => 'Classificações',
        'icon' => 'ion ion-clipboard',
        'color' => 'bg-yellow',
        'route' => 'classifications.index'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $quantidade = Classifications::count();

        return view('widgets.widget_classificacoes', [
            'config' => $this->config,
            'quantidade' => $quantidade
        ]);
    }
}
