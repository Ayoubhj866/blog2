<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthValidation;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthCOntroller extends Controller
{
    //


    /**
     * redireger un utilisateur vers la page d'authentification
     *
     * @return View
     */
    public function loginForm(): View
    {
        return \view("auth/login", ["test" => "je suis pour test"]);
    }


    /**
     * COnnecter un utilisateur
     *
     * @param AuthValidation $request
     * @return void
     */
    public function connect(AuthValidation $request)
    {
        //if true that's mean the user information are correct
        if (Auth::attempt($request->validated())) {
            //générer une session d'authentification pour l'utilisateur connecté
            $request->session()->regenerate();
            return redirect()->intended(route('blog.index'));
        }
        //redireger l'utilisateur vers la page de login avec un message d'erreur email ou mot de pass invalid
        return \to_route("loginForm")->withErrors([
            "invalidInfos" => "email ou mot de passe invalid",
        ])->onlyInput("email");
    }


    /**
     * Déconecté un utilisateur
     *
     * @return void
     */
    public function logout()
    {
        Auth::logout();
        return \to_route("blog.index");
    }
}
