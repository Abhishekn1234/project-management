<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Traits\HasPermissions;

class ProjectController extends Controller
{
    use HasPermissions;

    public function index(){
        if(!$this->hasPermission('view')) return redirect('/users')->with('error','Access denied');
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create(){
        if(!$this->hasPermission('create')) return redirect('/users')->with('error','Access denied');
        return view('projects.create');
    }

    public function store(Request $request){
        if(!$this->hasPermission('create')) return redirect('/users')->with('error','Access denied');
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required'
        ]);
        Project::create($request->only('name','description'));
        return redirect()->route('projects.index')->with('success','Project created');
    }

    public function edit(Project $project){
        if(!$this->hasPermission('update')) return redirect('/users')->with('error','Access denied');
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project){
        if(!$this->hasPermission('update')) return redirect('/users')->with('error','Access denied');
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required'
        ]);
        $project->update($request->only('name','description'));
        return redirect()->route('projects.index')->with('success','Project updated');
    }

    public function destroy(Project $project){
        if(!$this->hasPermission('delete')) return redirect('/users')->with('error','Access denied');
        $project->delete();
        return redirect()->route('projects.index')->with('success','Project deleted');
    }
}
