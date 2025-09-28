@extends('dashboard')

@section('content')
<h2>Edit Task Status</h2>
<form method="POST" action="{{ url('/task-statuses/'.$taskStatus->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Status Name:</label>
        <input type="text" name="name" class="form-control" value="{{ $taskStatus->name }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
