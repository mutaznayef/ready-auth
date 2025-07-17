@extends('layout.app')

@section('title', 'Roles')

@section('content')
<div class="py-4">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0">Roles</h3>
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">
                        Create
                    </a>
                </div>

                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Role Name</th>
                            <th scope="col">Auth Code</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->auth_code }}</td>
                            <td class="text-end">
                                <a href="{{ route('roles.edit', ['role' => $role->id]) }}"
                                    class="btn btn-sm btn-secondary me-1">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('roles.destroy', ['role' => $role->id]) }}"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this role?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if($roles->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center text-muted">No roles found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection