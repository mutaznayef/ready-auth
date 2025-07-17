@extends('layout.app') {{-- Replace with your layout --}}

@section('title', 'Edit Permission')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Card --}}
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Edit Permission</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('permissions.update', ['permission' => $permission->id]) }}">
                        @csrf
                        @method('PATCH')

                        {{-- Auth Code (disabled) --}}
                        <div class="mb-3">
                            <label for="auth_code" class="form-label">Auth Code</label>
                            <input type="text" id="auth_code" class="form-control" value="{{ $permission->auth_code }}"
                                disabled>
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" id="description" name="description"
                                value="{{ old('description', $permission->description) }}"
                                class="form-control @error('description') is-invalid @enderror" required autofocus>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>

                        {{-- Optional: Cancel Button --}}
                        <a href="{{ route('permissions.index') }}" class="btn btn-secondary ms-2">
                            Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection