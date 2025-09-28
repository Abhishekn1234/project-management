@extends('dashboard')

@section('content')
<h2>Tasks</h2>
<a href="{{ url('/tasks/create') }}" class="btn btn-success mb-3">Add Task</a>

<form method="GET" action="{{ url('/tasks') }}" class="mb-4 row g-3">
    <div class="col-md-2">
        <select name="status" class="form-control">
            <option value="">-- Select Status --</option>
            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
            <option value="waiting_verification" {{ request('status') == 'waiting_verification' ? 'selected' : '' }}>Waiting Verification</option>
            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="Expired" {{ request('status') == 'Expired' ? 'selected' : '' }}>Expired</option>
        </select>
    </div>

    <div class="col-md-2">
        <select name="project_id" class="form-control">
            <option value="">-- Select Project --</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <select name="assigned_to" class="form-control">
            <option value="">-- Select User --</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ request('assigned_to') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <input type="date" name="deadline" class="form-control" value="{{ request('deadline') }}" placeholder="Deadline">
    </div>

    <div class="col-md-2">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ url('/tasks') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>

@if($tasks->count() > 0)
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Project</th>
            <th>Assigned To</th>
            <th>Status</th>
            <th>Deadline</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        @php
            if(!in_array(strtolower($task->status), ['approved','waiting_verification','completed','expired']) 
                && now()->toDateString() > $task->deadline){
                $task->status = 'Expired';
                $task->save();
            }
        @endphp
        <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->title }}</td>
            <td>{{ $task->project->name ?? 'N/A' }}</td>
            <td>{{ $task->assignedUser->name ?? 'N/A' }}</td>
            <td>
                @php $status = strtolower($task->status); @endphp
                @if($status == 'waiting_verification')
                    <span class="badge bg-warning">Waiting Verification</span>
                @elseif($status == 'approved')
                    <span class="badge bg-success">Approved</span>
                @elseif($status == 'expired')
                    <span class="badge bg-danger">Expired</span>
                @else
                    <span class="badge bg-primary">{{ ucfirst($task->status) }}</span>
                @endif
            </td>
            <td>{{ $task->deadline }}</td>
            <td>
                <a href="{{ url('/tasks/'.$task->id.'/edit') }}" class="btn btn-primary btn-sm">Edit</a>
                
                <form action="{{ url('/tasks/'.$task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>

                @if($status == 'waiting_verification')
                    <form action="{{ url('/tasks/'.$task->id.'/approve') }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-success btn-sm">Approve</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
    <div class="alert alert-info">No records found.</div>
@endif
@endsection

