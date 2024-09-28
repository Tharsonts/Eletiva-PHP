<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Exibe o formulário de perfil do usuário.
     */
    public function edit()
    {
        return view('profile.index', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Atualiza as informações do perfil do usuário.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // Atualiza o nome do usuário
        if ($request->has('name')) {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $user->update(['name' => $request->name]);
            return back()->with('status', 'Nome atualizado com sucesso!');
        }
    }

    /**
     * Atualiza a senha do usuário.
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        // Valida a senha atual e nova
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Verifica se a senha atual está correta
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'A senha atual não está correta'])->withInput();
        }

        // Atualiza a senha do usuário
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile.edit')->with('success', 'Senha alterada com sucesso!');
    }
}
