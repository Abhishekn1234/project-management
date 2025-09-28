@extends('dashboard')

@section('content')
<h2>Create Role</h2>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ url('/roles') }}">
    @csrf
    <div class="mb-3">
        <label>Name:</label>
          <select name="name" id="name" class="form-control" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
    </div>
   <div class="mb-3">
    <label>Permissions:</label><br>
    <label><input type="checkbox" name="permissions[]" value="create"> Create</label>
    <label><input type="checkbox" name="permissions[]" value="update"> Update</label>
    <label><input type="checkbox" name="permissions[]" value="view"> View</label>
    <label><input type="checkbox" name="permissions[]" value="delete"> Delete</label>
</div>

    <button type="submit" class="btn btn-success">Create</button>
</form>
@endsection
