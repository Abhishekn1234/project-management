@extends('dashboard')

@section('content')
<h2>Edit Role</h2>
<form method="POST" action="{{ url('/roles/'.$role->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name:</label>
        <select name="name" id="name" class="form-control" required>
            <option value="admin" {{ $role->name === 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ $role->name === 'user' ? 'selected' : '' }}>User</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Permissions:</label>
        <input type="text" name="permissions" class="form-control" 
               value="{{ implode(',', $role->permissions ?? []) }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
