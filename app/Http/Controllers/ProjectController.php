<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Mostrar la lista de proyectos
    public function index()
    {
        $projects = Project::all();
        return view('admin.proyectos', compact('projects'));
    }

    // Mostrar el formulario para crear un nuevo proyecto
    public function create()
    {
        return view('admin.create_project');
    }

    // Almacenar un nuevo proyecto en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Project::create($request->all());

        return redirect()->route('admin.proyectos')->with('success', 'Proyecto creado exitosamente.');
    }

    // Mostrar un proyecto específico
    public function show(Project $project)
    {
        return view('admin.show_project', compact('project'));
    }

    // Mostrar el formulario para editar un proyecto existente
    public function edit(Project $project)
    {
        return view('admin.edit_project', compact('project'));
    }

    // Actualizar un proyecto existente en la base de datos
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($request->all());

        return redirect()->route('admin.proyectos')->with('success', 'Proyecto actualizado exitosamente.');
    }

    // Eliminar un proyecto
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.proyectos')->with('success', 'Proyecto eliminado exitosamente.');
    }
}
