@extends('layout.app')

@section('title', 'Users')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {{-- Card --}}
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Users</h4>
                </div>

                <div class="card-body">
                    {{-- Table --}}
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Admin</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->hasRole('admin') ? 'Yes' : 'No' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-sm btn-secondary me-1">
                                        Edit
                                    </a>

                                    @if (Auth::user()->id !== $user->id)
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Optional Pagination --}}
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection