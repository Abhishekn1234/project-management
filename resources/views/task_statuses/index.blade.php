@extends('dashboard')

@section('content')
<h2>Task Statuses</h2>
<a href="{{ url('/task-statuses/create') }}" class="btn btn-success mb-3">Add Status</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        

       @foreach($statuses as $status)
<tr>
    <td>{{ $status->id }}</td>
    <td>{{ $status->name }}</td>
    <td>
        <a href="{{ route('task_statuses.edit', $status->id) }}" class="btn btn-primary btn-sm">Edit</a>
        <form action="{{ route('task_statuses.destroy', $status->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </td>
</tr>
@endforeach

    </tbody>
</table>
@endsection
