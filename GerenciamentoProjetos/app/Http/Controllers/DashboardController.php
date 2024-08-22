<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Exibir o dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Lógica adicional pode ser adicionada aqui
        return view('dashboard.index');
    }
}
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Onde o usuário deve ser redirecionado após o registro.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Cria um novo usuário após o registro.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function registered(Request $request, $user)
    {
        return Redirect::to('/dashboard'); // Redireciona para o dashboard após o registro
    }
}
