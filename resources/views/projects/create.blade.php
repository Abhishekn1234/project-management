@extends('dashboard')

@section('content')
<h2>Create Project</h2>
<form method="POST" action="{{ url('/projects') }}">
    @csrf
    <div class="mb-3">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Description:</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Create</button>
</form>
@endsection
