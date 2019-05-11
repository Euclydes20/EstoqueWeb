<?php

namespace WebEstoque\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ----------------------------------------------------------------------------
 * Classe Fornecedores
 * ----------------------------------------------------------------------------
 */
class Providers extends Model
{
    /**
     * ------------------------------------------------------------------------
     * Define o nome da tabela para este controle
     * ------------------------------------------------------------------------
     *
     * @var string
     */
    protected $table = 'providers';

    /**
     * ------------------------------------------------------------------------
     * Propriedades que são atribuíveis em massa
     * ------------------------------------------------------------------------
     *
     * @var array
     */
    protected $fillable = [
        'nome'
    ];

    /**
     * ------------------------------------------------------------------------
     * Retorna todos os produtos que possua um determinado fornecedor
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
