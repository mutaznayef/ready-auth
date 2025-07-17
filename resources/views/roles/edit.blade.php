@extends('layout.app')

@section('title', 'Edit Role')

@section('content')
<div class="py-4">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="mb-4">Edit Role</h2>

                <form method="POST" action="{{ route('roles.update', ['role' => $role->id]) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="auth_code" class="form-label">Auth Code</label>
                        <input type="text" class="form-control" id="auth_code" name="auth_code"
                            value="{{ $role->auth_code }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $role->name) }}" required autocomplete="title" autofocus>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection