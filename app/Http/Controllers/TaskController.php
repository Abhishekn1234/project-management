<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Models\TaskStatus;
use App\Traits\HasPermissions;
use App\Events\TaskAssigned;

class TaskController extends Controller
{
    use HasPermissions;

   public function index(Request $request){
    if(!$this->hasPermission('view')) return redirect('/users')->with('error','Access denied');

    $query = Task::with(['project', 'assignedUser']);

  
    if($request->filled('status')){
        $query->where('status', $request->status);
    }


    if($request->filled('project_id')){
        $query->where('project_id', $request->project_id);
    }


    if($request->filled('assigned_to')){
        $query->where('assigned_to', $request->assigned_to);
    }

    
    if($request->filled('deadline')){
        $query->where('deadline', '<=', $request->deadline);
    }

    $tasks = $query->get();
    $projects = \App\Models\Project::all();
    $users = \App\Models\User::all();

    return view('tasks.index', compact('tasks','projects','users'));
}



    public function create(){
        if(!$this->hasPermission('create')) return redirect('/users')->with('error','Access denied');
        $projects = Project::all();
        $users = User::all();
        return view('tasks.create', compact('projects','users'));
    }

    public function store(Request $request){
        if(!$this->hasPermission('create')) return redirect('/users')->with('error','Access denied');
        $request->validate([
            'title'=>'required|string|max:255',
            'project_id'=>'required|exists:projects,id',
            'assigned_to'=>'required|exists:users,id',
            'status'=>'required',
            'deadline'=>'required|date'
        ]);
        $task = Task::create($request->all());
        event(new TaskAssigned($task));
        return redirect()->route('tasks.index')->with('success','Task created and assigned');
    }

    
    public function edit(Task $task){
        if(!$this->hasPermission('update')) return redirect('/users')->with('error','Access denied');
        $projects = Project::all();
        $users = User::all();
        $statuses = TaskStatus::all();
        return view('tasks.edit', compact('task','projects','users','statuses'));
    }

    public function update(Request $request, Task $task){
        if(!$this->hasPermission('update')) return redirect('/users')->with('error','Access denied');
        $request->validate([
            'title'=>'required|string|max:255',
            'project_id'=>'required|exists:projects,id',
            'assigned_to'=>'required|exists:users,id',
            'status'=>'required',
            'deadline'=>'required|date'
        ]);
        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success','Task updated');
    }

    public function destroy(Task $task){
        if(!$this->hasPermission('delete')) return redirect('/users')->with('error','Access denied');
        $task->delete();
        return redirect()->route('tasks.index')->with('success','Task deleted');
    }

 
   public function myTasks(){
    $userId = session('user_id');
    $tasks = Task::where('assigned_to', $userId)
                 ->whereNot('status','approved')
                 ->with(['project'])
                 ->get();

    foreach($tasks as $task){
        
        if(!in_array($task->status, ['Completed', 'waiting_verification', 'Expired']) 
           && now()->toDateString() > $task->deadline){
            $task->status = 'Expired';
            $task->save();
        }
    }

    return view('tasks.my-tasks', compact('tasks'));
}



  
   public function complete($id){
    $userId = session('user_id');
    $task = Task::where('id', $id)
                ->where('assigned_to', $userId)
                ->firstOrFail();

   
    if(now()->toDateString() > $task->deadline){
        $task->status = 'Expired';
        $task->save();
        return back()->with('error','Deadline passed. Task cannot be completed.');
    }

    $task->status = 'waiting_verification';
    $task->save();
    return back()->with('success','Task marked complete. Waiting for admin verification.');
}


  
    public function approve($id){
        if(!$this->hasPermission('update')) return redirect('/users')->with('error','Access denied');
        $task = Task::findOrFail($id);
        $task->status = 'approved';
        $task->save();
        return back()->with('success','Task approved successfully.');
    }
}
