<?php

namespace WebEstoque\Http\Controllers;

use Illuminate\Http\Request;
use WebEstoque\User;
use Auth;

class UsersController extends Controller
{
    /**
     * ------------------------------------------------------------------------
     * Somente usuários autenticados poderão acessar os métodos do
     * controller
     * ------------------------------------------------------------------------.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * ------------------------------------------------------------------------
     * Utilizado para exibir uma lista de classificações
     * ------------------------------------------------------------------------.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtém todos os registros da tabela de usuários
        $users = User::orderBy('id', 'asc')->paginate(5);

        // Chama a view passando os dados retornados da tabela
        return view('users.index', ['users' => $users]);
    }

    /**
     * ------------------------------------------------------------------------
     * Utilizado para exibir a view com o formulário para a inclusão de
     * um novo registro
     * ------------------------------------------------------------------------.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Chama a view com o formulário para inserir um novo registro
        return view('users.create');
    }

    /**
     * ------------------------------------------------------------------------
     * Utilizado para inserir os dados do formulário na tabela
     * ------------------------------------------------------------------------.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Cria as regras de validação dos dados do formulário
        $rules = [
            'name' => 'required|min:5|max:30',
            'email' => 'required|email|unique:users',
            'level' => 'required',
            'password' => 'required|min:6',
        ];

        // Cria o array com as mensagens de erros
        $messages = [
            'name' => 'Forneça o nome do usuários.',
            'email' => 'Forneça um e-mail válido.',
            'level' => 'Escolha o tipo de usuário.',
            'password' => 'Forneça uma senha válida para o usuário.',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules, $messages);

        // Cria um novo registro
        $user = new User();
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->level = $request->level;
        $user->password = bcrypt($request->password);

        // Salva os dados na tabela
        $user->save();

        // Retorna para view index com uma flash message
        return redirect()
            ->route('users.index')
            ->with('status', 'Registro criado com sucesso!');
    }

    /**
     * ------------------------------------------------------------------------
     * Exibe os dados de um determinado registro
     * ------------------------------------------------------------------------.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Localiza e retorna os dados de um registro pelo ID
        $user = User::findOrFail($id);

        // Chama a view para exibir os dados na tela
        return view('users.show', ['user' => $user]);
    }

    /**
     * ------------------------------------------------------------------------
     * Exibe um formulário com os dados de um determinado registro permitindo
     * que o usuário faça alterações
     * ------------------------------------------------------------------------.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Localiza o registro pelo seu ID
        $user = User::findOrFail($id);

        // Chama a view com o formulário para edição do registro
        return view('users.edit', ['user' => $user]);
    }

    /**
     * ------------------------------------------------------------------------
     * Utilizado para atualizados os dados do formulário na tabela
     * ------------------------------------------------------------------------.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Cria as regras de validação dos dados do formulário
        $rules = [
            'name' => 'required|min:5|max:30',
            'email' => 'required|email|unique:users,email,'.$id,
            'level' => 'required',
        ];

        // Cria o array com as mensagens de erros
        $messages = [
            'name' => 'Forneça o nome do usuários.',
            'email' => 'Forneça um e-mail válido.',
            'level' => 'Escolha o tipo de usuário',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules, $messages);

        // Le os dados do usuário
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->level = $request->level;

        // Se foi digitada uma senha ...
        if ($request->password != '') {
            $user->password = bcrypt($request->password);
        }

        // Salva os dados na tabela
        $user->save();

        // Retorna para view index com uma flash message
        return redirect()
            ->route('users.index')
            ->with('message', 'Registro atualizado com sucesso!')
            ->with('type', 'success');
    }

    /**
     * ------------------------------------------------------------------------
     * Utilizado para excluir um registro da tabela
     * ------------------------------------------------------------------------.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Retorna o registro pelo ID fornecido
        $user = User::findOrFail($id);

        // Recupera a URL da view que chamou o método
        $url = $_REQUEST['_return'];

        // Exclui o registro da tabela
        $user->delete();
        $message = 'Registro excluído com sucesso';
        $type = 'success';

        // Retorna para view index com uma flash message
        return redirect()->back()
            ->with('message', $message)
            ->with('type', $type);
    }

    /**
     * Edição dos dados do usuário logado.
     */
    public function editProfile()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);

        return view('profiles.edit', ['user' => $user]);
    }

    /**
     * Grava os dados do usuário logado.
     *
     * @param Request $request
     * @param [type]  $id
     */
    public function updateProfile(Request $request, $id)
    {
        // Cria as regras de validação dos dados do formulário
        $rules = [
            'name' => 'required|string|min:5',
            'email' => 'required|email',
        ];

        // Cria o array com as mensagens de erros
        $messages = [
            'name' => 'Forneça seu nome.',
            'email' => 'Forneça um e-mail válido',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules, $messages);

        // Le os dados do usuário
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->email = $request->email;

        // Se foi digitada uma senha ...
        if ($request->password != '') {
            $user->password = bcrypt($request->password);
        }

        // Salva os dados na tabela
        $user->save();

        // Retorna para view index com uma flash message
        return redirect()
            ->route('home')
            ->with('message', 'Registro atualizado com sucesso!')
            ->with('type', 'success');
    }
}
