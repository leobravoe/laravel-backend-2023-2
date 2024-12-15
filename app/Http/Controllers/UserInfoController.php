<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    /**
     * Construtor do UserInfoController
     */
    public function __construct()
    {
        $this->middleware('auth:web'); // Exigindo que a requeição contenha 
                                       // o guard web para acessar os métodos
    }

    public function index()
    {
        try {
            $message = Session::get('message'); // Essa variável irá existir quando for passada via with em um redirect
            // Id do usuário logado
            // use Illuminate\Support\Facades\Auth;
            $usersId = Auth::user()->id;
            $userinfo = UserInfo::find($usersId);
            if (isset($userinfo)) {
                return view("UserInfo/show")->with("userinfo", $userinfo)->with("message", $message);
            }
            return view("UserInfo/create")->with("message", $message);
        } catch (\Throwable $th) {
            return view("UserInfo/show")->with("userinfo", null)->with("message", [$th->getMessage(), "danger"]);
        }
    }

    public function store(Request $request)
    {
        try {
            // Id do usuário logado
            // use Illuminate\Support\Facades\Auth;
            $usersId = Auth::user()->id;
            $userinfo = new UserInfo();
            $userinfo->Users_id = $usersId;
            $userinfo->profileImg = $request->profileImg;
            $userinfo->status = 'A';
            $userinfo->dataNasc = $request->dataNasc;
            $userinfo->genero = $request->genero;
            $userinfo->save();
            return redirect()->route("userinfo.index")->with("message", ["UserInfo cadastrado com sucesso", "success"]);
        } catch (\Throwable $th) {
            return redirect()->route("userinfo.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $message = Session::get('message'); // Essa variável irá existir quando for passada via with em um redirect
            // Id do usuário logado
            // use Illuminate\Support\Facades\Auth;
            $usersId = Auth::user()->id;
            $userinfo = UserInfo::find($usersId);
            if (isset($userinfo)) {
                return view("UserInfo/show")->with("userinfo", $userinfo)->with("message", $message);
            }
            return view("UserInfo/create")->with("message", $message);
        } catch (\Throwable $th) {
            return view("UserInfo/show")->with("userinfo", null)->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $message = Session::get('message'); // Essa variável irá existir quando for passada via with em um redirect
            // Id do usuário logado
            // use Illuminate\Support\Facades\Auth;
            $usersId = Auth::user()->id;
            $userinfo = UserInfo::find($usersId);
            if (isset($userinfo)) {
                return view("UserInfo/show")->with("userinfo", $userinfo)->with("message", $message);
            }
            return view("UserInfo/create")->with("message", $message);
        } catch (\Throwable $th) {
            return view("UserInfo/show")->with("userinfo", null)->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $usersId = Auth::user()->id;
            $userinfo = UserInfo::find($usersId);
            if (isset($userinfo)) {
                return view("UserInfo/edit")->with("userinfo", $userinfo);
            }
            return view("UserInfo/create");
        } catch (\Throwable $th) {
            return view("UserInfo/show")->with("userinfo", null)->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $usersId = Auth::user()->id;
            $userinfo = UserInfo::find($usersId);
            if (isset($userinfo)) {
                $userinfo->profileImg = $request->profileImg;
                $userinfo->status = $request->status;
                $userinfo->dataNasc = $request->dataNasc;
                $userinfo->genero = $request->genero;
                $userinfo->update();
                return redirect()->route("userinfo.show", $usersId)->with("message", ["UserInfo cadastrado com sucesso", "success"]);
            }
            return redirect()->route("userinfo.create")->with("message", ["Userinfo não foi encontrado", "warning"]);
        } catch (\Throwable $th) {
            return redirect()->route("userinfo.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $usersId = Auth::user()->id;
            $userinfo = UserInfo::find($usersId);
            if (isset($userinfo)) {
                $userinfo->delete();
                return redirect()->route("userinfo.create")->with("message", ["UserInfo apagado com sucesso", "success"]);
            }
            return redirect()->route("userinfo.create")->with("message", ["Userinfo não foi encontrado", "warning"]);
        } catch (\Throwable $th) {
            return redirect()->route("userinfo.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }
}
