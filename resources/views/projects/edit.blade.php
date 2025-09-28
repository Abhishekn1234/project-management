@extends('dashboard')

@section('content')
<h2>Edit Project</h2>
<form method="POST" action="{{ url('/projects/'.$project->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Title:</label>
        <input type="text" name="name" class="form-control" value="{{ $project->name }}" required>
    </div>
    <div class="mb-3">
        <label>Description:</label>
        <textarea name="description" class="form-control" rows="3">{{ $project->description }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
