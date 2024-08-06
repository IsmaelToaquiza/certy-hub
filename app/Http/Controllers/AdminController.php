<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Mostrar la lista de administradores
    public function index()
    {
        $administrators = User::where('role_id', 1)->get();
        return view('admin.administradores', compact('administrators'));
    }

    // Mostrar el formulario para crear un nuevo administrador
    public function create()
    {
        return view('admin.create_admin');
    }

    // Almacenar un nuevo administrador en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8', // Mínimo de 12 caracteres
                'max:64', // Máximo de 64 caracteres
                'regex:/[a-z]/', // Al menos una letra minúscula
                'regex:/[A-Z]/', // Al menos una letra mayúscula
                'regex:/[0-9]/', // Al menos un número
                'regex:/[@$!%*?&#]/', // Al menos un carácter especial
                'confirmed', // Confirmación
            ],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 1, // Asignar el rol de administrador
        ]);

        return redirect()->route('admin.administradores')->with('success', 'Administrador creado exitosamente.');
    }

    // Mostrar un administrador específico
    public function show(User $administrator)
    {
        return view('admin.show_admin', compact('administrator'));
    }

    // Mostrar el formulario para editar un administrador existente
    public function edit(User $administrator)
    {
        return view('admin.edit_admin', compact('administrator'));
    }

    // Actualizar un administrador existente en la base de datos
    public function update(Request $request, User $administrator)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $administrator->id,
            'password' => [
                'required',
                'string',
                'min:8', // Mínimo de 12 caracteres
                'max:64', // Máximo de 64 caracteres
                'regex:/[a-z]/', // Al menos una letra minúscula
                'regex:/[A-Z]/', // Al menos una letra mayúscula
                'regex:/[0-9]/', // Al menos un número
                'regex:/[@$!%*?&#]/', // Al menos un carácter especial
                'confirmed', // Confirmación
            ],
        ]);

        $data = $request->only('name', 'email');
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $administrator->update($data);

        return redirect()->route('admin.administradores')->with('success', 'Administrador actualizado exitosamente.');
    }

    // Eliminar un administrador
    public function destroy(User $administrator)
    {
        $administrator->delete();

        return redirect()->route('admin.administradores')->with('success', 'Administrador eliminado exitosamente.');
    }
}
