@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Tasks</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>

    @if($tasks->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Project</th>
                    <th>Assigned To</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->project->name ?? '-' }}</td>
                        <td>{{ $task->assignedUser->name ?? '-' }}</td>
                        <td>
                            @if($task->status == 'waiting_verification')
                                <span class="badge bg-warning">Waiting Verification</span>
                            @elseif($task->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-primary">{{ ucfirst($task->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $task->deadline }}</td>
                        <td>
                            @if($task->status == 'waiting_verification')
                                <form action="{{ url('/tasks/'.$task->id.'/approve') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>
                            @else
                                <span class="text-muted">No Action</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No tasks created yet.</p>
    @endif
</div>
@endsection
