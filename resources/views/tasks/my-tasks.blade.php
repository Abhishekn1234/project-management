@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Tasks</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($tasks->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Project</th>
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
                        <td>
                            @if($task->status == 'waiting_verification')
                                <span class="badge bg-warning">Waiting Verification</span>
                            @else
                                <span class="badge bg-primary">{{ ucfirst($task->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $task->deadline }}</td>
                     <td>
    @if($task->status != 'waiting_verification' && $task->status != 'Expired')
        <form action="{{ url('/tasks/'.$task->id.'/complete') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success btn-sm">Complete</button>
        </form>
    @elseif($task->status == 'Expired')
        <span class="text-danger">Task Expired. Cannot complete.</span>
    @else
        <span class="text-muted">Pending Approval</span>
    @endif
</td>


                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No tasks assigned yet.</p>
    @endif
</div>
@endsection
