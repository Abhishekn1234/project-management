@extends('dashboard')

@section('content')
<h2>Roles</h2>
<a href="{{ url('/roles/create') }}" class="btn btn-success mb-3">Add Role</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Permissions</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr>
            <td>{{ $role->id }}</td>
            <td>{{ $role->name }}</td>
            <td>{{ implode(', ', is_array($role->permissions) ? $role->permissions : json_decode($role->permissions, true) ?? []) }}</td>

            <td>
                <a href="{{ url('/roles/'.$role->id.'/edit') }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ url('/roles/'.$role->id) }}" method="POST" style="display:inline;">
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

