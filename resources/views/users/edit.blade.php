@extends('dashboard')

@section('content')
<h2>Edit User</h2>
<form method="POST" action="{{ url('/users/'.$user->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="mb-3">
        <label>Email:</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>
   <div class="mb-3">
    <label>Role:</label>
    <select name="role_id" class="form-control" required>
        <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>
        <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>User</option>
    </select>
</div>


    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
