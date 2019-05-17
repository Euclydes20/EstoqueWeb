<?php

namespace WebEstoque\Http\Controllers;

use WebEstoque\Models\Products;
// use WebEstoque\Models\Classifications;
// use WebEstoque\Models\Providers;
use Illuminate\Http\Request;
use Auth;
use Route;

/**
 * ----------------------------------------------------------------------------
 * Controler para a tabela de produtos
 * ----------------------------------------------------------------------------
 */

class ProductsController extends Controller
{
    /**
     * ------------------------------------------------------------------------
     * Somente usuários autenticados poderão acessar os métodos do
     * controller
     * ------------------------------------------------------------------------
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * ------------------------------------------------------------------------
     * Utilizado para exibir uma lista de produtos
     * ------------------------------------------------------------------------
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtém todos os registros da tabela de fornecedores
        $products = Products::orderBy('id', 'asc')->paginate(5);


        // Chama a view passando os dados retornados da tabela
        return view('products.index',[ 'products' => $products ]);
    }

    /**
     * ------------------------------------------------------------------------
     * Utilizado para exibir a view com o formulário para a inclusão de
     * um novo registro
     * ------------------------------------------------------------------------
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Chama a view com o formulário para inserir um novo registro
        return view('products.create');
    }


    /**
     * ------------------------------------------------------------------------
     * Utilizado para inserir os dados do formulário na tabela
     * ------------------------------------------------------------------------
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Cria as regras de validação dos dados do formulário
        $rules = [
            'descricao' => 'required|string',
            'qtd' => 'required|int|min:0',
            'estoque_minimo' => 'required|int|min:0',
            'prc_venda' => 'required',
            'prc_compra' => 'required',
            'provider_id' => 'required',
            'classification_id' => 'required'
        ];

        // Cria o array com as mensagens de erros
        $messages = [
            'descricao' => 'Forneça a descrição do produto',
            'qtd' => 'A quantidade mínima deve ser 0.',
            'estoque_minimo' => 'Forneça um valor para o estoque minimo',
            'prc_venda' => 'Forneça o valor de venda do produto.',
            'prc_compra' => 'Fornecá o valor de compra do produto.',
            'provider_id' => 'Selecione um fornecedor do produto.',
            'classification_id' => 'Selecione a classificação do produto.'
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules, $messages);

        // Cria um novo registro
        $product = new Products;
        $product->descricao = $request->descricao;
        $product->qtd = $request->qtd;
        $product->estoque_minimo = $request->estoque_minimo;
        $product->prc_venda = $request->prc_venda;
        $product->prc_compra = $request->prc_compra;
        $product->provider_id = $request->provider_id;
        $product->classification_id = $request->classification_id;

        // Salva os dados na tabela
        $product->save();

        // Retorna para view index com uma flash message
        return redirect()
            ->route('products.index')
            ->with('status', 'Registro atualizado com sucesso!');
    }

    /**
     * ------------------------------------------------------------------------
     * Exibe os dados de um determinado registro
     * ------------------------------------------------------------------------
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Localiza e retorna os dados de um registro pelo ID
        $product = Products::findOrFail($id);

        // Chama a view para exibir os dados na tela
        return view('products.show',[ 'product' => $product ]);
    }

    /**
     * ------------------------------------------------------------------------
     * Exibe um formulário com os dados de um determinado registro permitindo
     * que o usuário faça alterações
     * ------------------------------------------------------------------------
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Localiza o registro pelo seu ID
        $product = Products::findOrFail($id);

        // Chama a view com o formulário para edição do registro
        return view('products.edit',[ 'product' => $product ]);
    }


    /**
     * ------------------------------------------------------------------------
     * Utilizado para atualizados os dados do formulário na tabela
     * ------------------------------------------------------------------------
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Cria as regras de validação dos dados do formulário
        $rules = [
            'descricao' => 'required|string',
            'qtd' => 'required|int|min:0',
            'estoque_minimo' => 'required|int|min:0',
            'prc_venda' => 'required',
            'prc_compra' => 'required',
            'provider_id' => 'required',
            'classification_id' => 'required'
        ];

        // Cria o array com as mensagens de erros
        $messages = [
            'descricao' => 'Forneça a descrição do produto',
            'qtd' => 'A quantidade mínima deve ser 0.',
            'estoque_minimo' => 'Forneça um valor para o estoque minimo',
            'prc_venda' => 'Forneça o valor de venda do produto.',
            'prc_compra' => 'Fornecá o valor de compra do produto.',
            'provider_id' => 'Selecione um fornecedor do produto.',
            'classification_id' => 'Selecione a classificação do produto.'
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules, $messages);

        // Cria um novo registro
        $product = Products::findOrFail($id);
        $product->descricao = $request->descricao;
        $product->qtd = $request->qtd;
        $product->estoque_minimo = $request->estoque_minimo;
        $product->prc_venda = $request->prc_venda;
        $product->prc_compra = $request->prc_compra;
        $product->provider_id = $request->provider_id;
        $product->classification_id = $request->classification_id;

        // Salva os dados na tabela
        $product->save();

        // Retorna para view index com uma flash message
        return redirect()
            ->route('products.index')
            ->with('status', 'Registro atualizado com sucesso!');
    }

    /**
     * ------------------------------------------------------------------------
     * Utilizado para excluir um registro da tabela
     * ------------------------------------------------------------------------
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Retorna o registro pelo ID fornecido
        $product = Products::findOrFail($id);

        try {
            // Exclui o registro da tabela
            $product->delete();
            $message = 'Registro excluído com sucesso';
            $type = 'success';
        } catch (\Throwable $th) {
            // Se der algum erro na exclusão ...
            $message = 'O registro não pode ser excluído.';

            // Se o erro foi por violação da restrição da chave estrangeira ...
            if (strpos($th->errorInfo[2], 'Cannot delete or update a parent row') !== false) {
                $message .= ' Este registro está sendo utilizado em pelo menos um produto.';
            }

            $type = 'danger';
        }

        // Retorna para view index com uma flash message
        return redirect()->back()
            ->with('message', $message)
            ->with('type', $type);
    }
}
