<?php

namespace App\Http\Controllers;

use App\Address;
use App\Branch;
use App\City;
use App\Client;
use App\State;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('Branch')->get();
        return view('user.list')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all()->whereNull('deleted_at');
        $userCount = User::all()->whereNull('deleted_at')->where('branch_id', Cookie::get('branch_id'));
        return view('user.create')->with(['userCount' => count($userCount), 'branches'=> $branches]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cpf' => 'required',
            'name' => 'required',
            'email' => 'required',
            'admin' => 'required',
            'password' => 'required',
        ]);
        //Salva Usuário

        $user = new User();
        $user->cpf = $validatedData['cpf'];
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->admin = $validatedData['admin'];
        $user->password = bcrypt($validatedData['password']);
        $user->branch_id = Cookie::get('branch_id');
        $user->save();
        return redirect()->back()->with([
            'status' => "Usuário inserido com sucesso!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        $branches = Branch::all()->whereNull('deleted_at');
        if ($id != null) {
            $userCount = User::all();

            if (is_numeric($id)) {
                $user = User::where('id', $id)->first();
                $branch = Branch::where('id', $user->branch_id)->first();
            } else {
                $id = Auth::user()->id;
                $user = User::where('id', $id)->first();
                $branch = Branch::where('id', $user->branch_id)->first();
            }
            $is_adm = "";
            if ($user->admin == 1) {
                $is_adm = "Sim";
            } else {
                $is_adm = "Não";
            }
            return view('user.edit')->with(['user' => $user, 'branch' => $branch, 'userCount' => $userCount, 'is_adm' => $is_adm, 'branches'=> $branches]);
        } else {
            $branch = Branch::where('id', Auth::user()->branch_id)->first();
            return view('user.edit')->with(['user' => Auth::user(), 'branch' => $branch, 'is_adm' => Auth::user()->admin, 'branches'=> $branches]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $error = 0;
        $status = "";
        $validatedData = $request->validate([
            'id' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
        ]);
        if ($validatedData['password'] != $validatedData['confirm_password']) {
            $error = 1;
            $status = $status . ' Senha e senha de confirmação digitadas não coincidem.';
        }
        if (strlen($validatedData['password']) < 5) {
            $error = 1;
            $status = $status . ' Senha muito curta.';
        }
        if ($error == 0) {
            $user = User::find($validatedData['id']);
            $user->email = $validatedData['email'];
            $user->password = bcrypt($validatedData['password']);
            $user->save();

            return redirect()->back()->with([
                'status' => "Dados alterados com sucesso para o usuário $user->name!"
            ]);
        } else
            return redirect()->back()->with([
                'status' => "Ocorreu os seguintes erros ao modificar: $status"
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required'
        ]);
        $user = Client::find($validatedData['id']);
        if($user != null){
            $user->deleted_at = Carbon::now();
            $user->save();
        }
        return redirect()->back()->with(['status' => "Usuário: ".$user->name." deletado com sucesso!"]);
    }
}
