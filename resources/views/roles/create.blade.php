@extends('layout.app')

@section('title', 'Create Role')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create New Role</h5>
                    <a href="{{ route('roles.index') }}" class="btn btn-sm btn-outline-secondary">
                        ← Back to Roles
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf

                        {{-- Auth Code --}}
                        <div class="mb-3">
                            <label for="auth_code" class="form-label">Auth Code</label>
                            <input type="text" class="form-control @error('auth_code') is-invalid @enderror"
                                id="auth_code" name="auth_code" value="{{ old('auth_code') }}" required autofocus>
                            @error('auth_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Actions --}}
                        <div class="d-flex justify-content-start align-items-center gap-3">
                            <button type="submit" class="btn btn-primary">
                                Save Role
                            </button>
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection