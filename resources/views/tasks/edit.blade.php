@extends('dashboard')

@section('content')
<h2>Edit Task</h2>
<form method="POST" action="{{ url('/tasks/'.$task->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Title:</label>
        <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
    </div>
    <div class="mb-3">
        <label>Description:</label>
        <textarea name="description" class="form-control" rows="3">{{ $task->description }}</textarea>
    </div>
    <div class="mb-3">
    <label>Deadline:</label>
    <input type="date" name="deadline" class="form-control" 
           value="{{ $task->deadline }}" required>
</div>

    <div class="mb-3">
        <label>Project:</label>
        <select name="project_id" class="form-control" required>
            @foreach($projects as $project)
                <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Assign To:</label>
        <select name="assigned_to" class="form-control" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $task->assigned_to == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
    <label>Status:</label>
    <select name="status" class="form-control" required>
        @php
            $taskStatuses = ['Pending', 'In Progress', 'Completed', 'On Hold', 'Cancelled'];
        @endphp

        @foreach($taskStatuses as $status)
            <option value="{{ $status }}" {{ isset($task) && $task->status == $status ? 'selected' : '' }}>
                {{ $status }}
            </option>
        @endforeach
    </select>
</div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
