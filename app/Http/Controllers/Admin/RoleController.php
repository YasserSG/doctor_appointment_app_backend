<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.roles.index');
    }

    // ----------------------------------------------------
    //  CORRECCIONES PARA LA PANTALLA BLANCA
    // ----------------------------------------------------

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // El método debe retornar una vista.
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /**validar que se cree bien **/
        $request->validate(['name' => 'required|unique:roles,name']);

        /** Si pasa la validacion, creará el rol**/
        Role::create(['name' => $request->name]);


        // variable de un solo uso para alertas
        session()->flash('swal',
        [
           'icon' => 'success',
           'title' => 'Rol creado correctamente!',
            'text' => 'El rol ha sido creado exitosamente.',
        ]);
        /** Redireccionará a la tabla principal**/
        return redirect()->route('admin.roles.index')
             ->with('success', 'Rol created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // 1. Busca el rol que se quiere editar (si no existe, lanza 404).
        $role = Role::findOrFail($id);

        // 2. Retorna la vista de edición y le pasa el objeto $role.
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
