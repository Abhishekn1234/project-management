<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskStatus;
use App\Traits\HasPermissions;
use Illuminate\Support\Facades\Log;

class TaskStatusController extends Controller
{
    use HasPermissions;

 
    public function index()
    {
        if (!$this->hasPermission('view')) {
            return redirect('/users')->with('error', 'Access denied');
        }

        $statuses = TaskStatus::all();

        return view('task_statuses.index', compact('statuses'));
    }

 
    public function create()
    {
        if(!$this->hasPermission('create')) {
            return redirect('/users')->with('error','Access denied');
        }
        return view('task_statuses.create');
    }

  
    public function store(Request $request)
    {
        if(!$this->hasPermission('create')) {
            return redirect('/users')->with('error','Access denied');
        }

        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        TaskStatus::create($request->only('name'));

        return redirect()->route('task-statuses.index')->with('success','Status created successfully');
    }

    
    public function edit(TaskStatus $taskStatus)
    {
        if(!$this->hasPermission('update')) {
            return redirect('/users')->with('error','Access denied');
        }

        return view('task_statuses.edit', compact('taskStatus'));
    }


    public function update(Request $request, TaskStatus $taskStatus)
    {
        if(!$this->hasPermission('update')) {
            return redirect('/users')->with('error','Access denied');
        }

        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $taskStatus->update($request->only('name'));

        return redirect()->route('task-statuses.index')->with('success','Status updated successfully');
    }

   
    public function destroy(TaskStatus $taskStatus)
    {
        if(!$this->hasPermission('delete')) {
            return redirect('/users')->with('error','Access denied');
        }

        $taskStatus->delete();

        return redirect()->route('task-statuses.index')->with('success','Status deleted successfully');
    }
}
