@extends('admin.layout-simple')

@section('title', 'Test User Management')

@section('content')
<div class="container-fluid">
    <h1>User Management Test</h1>
    
    <div class="card">
        <div class="card-body">
            <h5>User List</h5>
            
            @if(isset($users) && $users->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->is_active ? 'Active' : 'Inactive' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{ $users->links() }}
            @else
                <p>No users found or users variable not set.</p>
                <p>Users variable type: {{ gettype($users ?? 'undefined') }}</p>
                @if(isset($users))
                    <p>Users count: {{ $users->count() }}</p>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
