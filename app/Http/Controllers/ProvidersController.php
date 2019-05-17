<?php

namespace WebEstoque\Http\Controllers;

use WebEstoque\Models\Providers;
use Illuminate\Http\Request;
use Auth;
use Route;

/**
 * ----------------------------------------------------------------------------
 * Controler para a tabela de fornecedores
 * ----------------------------------------------------------------------------
 */
class ProvidersController extends Controller
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
     * Utilizado para exibir uma lista de fornecedores
     * ------------------------------------------------------------------------
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtém todos os registros da tabela de fornecedores
        $providers = Providers::orderBy('id', 'asc')->paginate(5);

        // Chama a view passando os dados retornados da tabela
        return view('providers.index',[ 'providers' => $providers ]);
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
        return view('providers.create');
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
            'nome' => 'required|min:5|max:30'
        ];

        // Cria o array com as mensagens de erros
        $messages = [
            'nome.unique' => 'Só pode ter um único fornecedor com este nome no banco de dados.'
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules, $messages);

        // Cria um novo registro
        $provider = new Providers;
        $provider->nome = $request->nome;

        // Salva os dados na tabela
        $provider->save();

        // Retorna para view index com uma flash message
        return redirect()
            ->route('providers.index')
            ->with('status', 'Registro criado com sucesso!');
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
        $provider = Providers::findOrFail($id);

        // Chama a view para exibir os dados na tela
        return view('providers.show',[ 'provider' => $provider ]);
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
        $provider = Providers::findOrFail($id);

        // Chama a view com o formulário para edição do registro
        return view('providers.edit',[ 'provider' => $provider ]);
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
            'nome' => 'required|string|min:5|max:50'
        ];

        // Cria o array com as mensagens de erros
        $messages = [
            'nome.unique' => 'Só pode existir um fornecedor com esse nome no banco de dados.'
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules, $messages);

        // Cria um novo registro
        $provider = Providers::findOrFail($id);
        $provider->nome = $request->nome;

        // Salva os dados na tabela
        $provider->save();

        // Retorna para view index com uma flash message
        return redirect()
            ->route('providers.index')
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
        $provider = Providers::findOrFail($id);

        try {
            // Exclui o registro da tabela
            $provider->delete();
            $message = 'Registro excluído com sucesso';
            $type = 'success';

        } catch (\Throwable $th) {
            // Se der algum erro na exclusão ...
            $message = 'O registro não pode ser excluído.';

            // Se o erro foi por violação da restrição da chave estrangeira ...
            if (strpos($th->errorInfo[2],'Cannot delete or update a parent row') !== false) {
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
