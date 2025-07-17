@extends('layout.app') {{-- Or whatever layout you use --}}

@section('title', 'Permissions')

@section('content')
<div class="container py-5">
    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Permissions</h2>
        <a href="{{ route('permissions.create') }}" class="btn btn-primary">
            + Create
        </a>
    </div>

    {{-- Card Wrapper --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">Roles</h4>

            {{-- Permissions Table --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Auth Code</th>
                            <th>Description</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $permission)
                        <tr>
                            <td>{{ $permission->auth_code }}</td>
                            <td>{{ $permission->description }}</td>
                            <td class="text-end">
                                <a href="{{ route('permissions.edit', $permission->id) }}"
                                    class="btn btn-sm btn-secondary me-1">
                                    Edit
                                </a>

                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this permission?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No permissions found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection