@extends('layout.app')

@section('title', 'Edit User')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Edit User</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PATCH')

                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $user->name) }}" required autofocus
                                autocomplete="name">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- roles (multiple select) --}}
                        <div class="mb-3">
                            <label for="roles" class="form-label">roles</label>
                            <select name="roles[]" id="roles" class="form-select @error('roles') is-invalid @enderror"
                                multiple>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->roles->contains($role) ? 'selected' : ''
                                    }}>
                                    {{ $role->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('roles')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Permissions (multiple select) --}}
                        <div class="mb-3">
                            <label for="permissions" class="form-label">Permissions</label>
                            <select name="permissions[]" id="permissions"
                                class="form-select @error('permissions') is-invalid @enderror" multiple>
                                @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}" {{ $user->hasPermissionTo($permission->auth_code)
                                    ?
                                    'selected' : '' }}>
                                    {{ $permission->description }}
                                </option>
                                @endforeach
                            </select>
                            @error('permissions')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Submit button --}}
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection