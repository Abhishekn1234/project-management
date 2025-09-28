@extends('dashboard')

@section('content')
<div class="container-fluid">

  
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Users</h5>
            <a href="{{ url('/users/create') }}" class="btn btn-success btn-sm">Add User</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name ?? 'User' }}</td>
                        <td>
                            <a href="{{ url('/users/'.$user->id.'/edit') }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ url('/users/'.$user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
