@extends('layout.app') {{-- Adjust if your layout name is different --}}

@section('title', 'Create Permission')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Card --}}
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Create Permission</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('permissions.store') }}">
                        @csrf

                        {{-- Auth Code --}}
                        <div class="mb-3">
                            <label for="auth_code" class="form-label">Auth Code</label>
                            <input type="text" id="auth_code" name="auth_code" value="{{ old('auth_code') }}"
                                class="form-control @error('auth_code') is-invalid @enderror" required>
                            @error('auth_code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" id="description" name="description" value="{{ old('description') }}"
                                class="form-control @error('description') is-invalid @enderror" required>
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

                        {{-- Optional: Cancel --}}
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