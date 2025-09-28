@extends('dashboard')

@section('content')
<h2>Create Task</h2>
<form method="POST" action="{{ url('/tasks') }}">
    @csrf
    <div class="mb-3">
        <label>Title:</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Description:</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label>Project:</label>
        <select name="project_id" class="form-control" required>
            @foreach($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Assign To:</label>
        <select name="assigned_to" class="form-control" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
    <label>Deadline:</label>
    <input type="date" name="deadline" class="form-control" required>
</div>

    <div class="mb-3">
    <label>Status:</label>
    <select name="status" class="form-control" required>
        @php
            $taskStatuses = ['Pending', 'In Progress', 'Completed', 'On Hold', 'Cancelled'];
        @endphp

        @foreach($taskStatuses as $status)
            <option value="{{ $status }}" 
                {{ isset($task) && $task->status == $status ? 'selected' : '' }}>
                {{ $status }}
            </option>
        @endforeach
    </select>
</div>

    <button type="submit" class="btn btn-success">Create</button>
</form>
@endsection

