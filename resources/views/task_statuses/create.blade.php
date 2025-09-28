@extends('dashboard')

@section('content')
<h2>Create Task Status</h2>
<form method="POST" action="{{ url('/task-statuses') }}">
    @csrf
    <div class="mb-3">
        <label>Status Name:</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Create</button>
</form>
@endsection
