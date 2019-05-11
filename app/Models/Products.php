<?php

namespace WebEstoque\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ----------------------------------------------------------------------------
 * Classe Produtos
 * ----------------------------------------------------------------------------
 */
class Products extends Model
{
    /**
     * ------------------------------------------------------------------------
     * Define o nome da tabela para este controle
     * ------------------------------------------------------------------------
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * ------------------------------------------------------------------------
     * Propriedades que são atribuíveis em massa
     * ------------------------------------------------------------------------
     *
     * @var array
     */
    protected $fillable = [
        'descricao', 'qtd', 'prc_venda', 'prc_compra'
    ];

    /**
     * ------------------------------------------------------------------------
     * Retorna o registro da classificação de um determinado produto
     * ------------------------------------------------------------------------
     *
     * @return void
     */
    public function classification()
    {
        return $this->belongsTo('\WebEstoque\Models\Classifications');
    }

    /**
     * ------------------------------------------------------------------------
     * Retorna o registro do Fornecedor de um determinado produto
     * ------------------------------------------------------------------------
     *
     * @return void
     */
    public function provider()
    {
        return $this->belongsTo('\WebEstoque\Models\Providers');
    }

}
