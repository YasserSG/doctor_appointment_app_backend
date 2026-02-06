<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User; // <-- ¡Importante para el Criterio 1!
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Criterio 2: Incluir la vista index
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        // Criterio 2: Incluir la vista create
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'id_number' => 'required|string|min:5|max:20|regex:/^[A-Za-z0-9\-]+$/|unique:users',
            'phone' => 'required|digits_between:7,15',
            'address' => 'required|string|min:3|max:255',
            'role' => 'required|exists:roles,id',
        ]);

        $user = User::create($data);
        $user->assignRole($data['role_id']);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario creado',
            'text' => 'El usuario ha sido creado exitosamente!.'
            ]);

        //Si el usuario creado es un paciente envia el modulo paciente
        if($user::role('Paciente')){
            //Creamos el registro para un paciente
            $patient = $user->patient()->create([]);
            return redirect()->route('admin.patients.edit', $patient);

        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
       $roles = Role::all();
        // Criterio 2: Incluir la vista edit
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'id_number' => 'required|string|min:5|max:20|regex:/^[A-Za-z0-9\-]+$/|unique:users,id_number,' . $user->id,
            'phone' => 'required|digits_between:7,15',
            'address' => 'required|string|min:3|max:255',
            'role' => 'required|exists:roles,id',
        ]);

        $user->update($data);


        //si el usuario quiere editar su contraseña, que lo guarde
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->route('admin.users.index');

        }

        $user->roles()->sync($data['role_id']);


        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario actualizado',
            'text' => 'El usuario ha sido actualizado exitosamente!.'

        ]);

        return redirect()->route('admin.users.edit', $user->id)->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
      //Eliminar roles asociados a un usario
        $user->roles()->detach();

        // No permitir que el usuario logueado se borre a si mismo
        if (Auth::user()->id === $user->id)  {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'error',
                'text' => 'No se puede eliminar este usuario!',
            ]);
            abort(403, 'No puedes borrar tu mismo usuario');
        }
        //Eliminar el usuario
        $user->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario eliminado',
            'text' => 'El usuario ha sido eliminado exitosamente!.'
        ]);
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
