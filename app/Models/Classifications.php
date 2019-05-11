<?php

namespace WebEstoque\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ----------------------------------------------------------------------------
 * Classe Classificação de Produtos
 * ----------------------------------------------------------------------------
 */
class Classifications extends Model
{
    /**
     * ------------------------------------------------------------------------
     * Define o nome da tabela para este controle
     * ------------------------------------------------------------------------
     *
     * @var string
     */
    protected $table = 'classifications';

    /**
     * ------------------------------------------------------------------------
     * Define os campos que são atribuíveis em massa
     * ------------------------------------------------------------------------
     *
     * @var array
     */
    protected $fillable = [
        'descricao'
    ];

    /**
     * ------------------------------------------------------------------------
     * Retorna todos os produtos que possua uma determinada classificação
     * ------------------------------------------------------------------------
     *
     * :: Verbos permitidos::
     * - hasOne - Relacionamento 1:1
     * - hasMany - Relacionamento 1:N
     * - belongsTo - Relacionamento N:1 (inverso de hasMany)
     * - belongsToMany - Relacionamento N:M
     *
     * @return void
     */
    public function products()
    {
        return $this->hasMany('\App\Models\Products');
    }
}
