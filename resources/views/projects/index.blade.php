@extends('dashboard')

@section('content')
<h2>Projects</h2>
<a href="{{ url('/projects/create') }}" class="btn btn-success mb-3">Add Project</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
        <tr>
            <td>{{ $project->id }}</td>
            <td>{{ $project->name }}</td>
            <td>{{ $project->description }}</td>
            <td>
                <a href="{{ url('/projects/'.$project->id.'/edit') }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ url('/projects/'.$project->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
