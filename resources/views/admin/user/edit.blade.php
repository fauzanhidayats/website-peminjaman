@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Pengguna</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('users.index') }}">Pengguna</a></div>
                <div class="breadcrumb-item active">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Edit Pengguna</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        value="{{ old('username', $user->username) }}" required>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password <small class="text-muted">(Kosongkan jika tidak ingin
                                            mengubah)</small></label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label for="photo">Foto Pengguna</label><br>
                                    @if ($user->photo)
                                        <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto Pengguna" width="100"
                                            class="mb-2 rounded-circle">
                                    @endif
                                    <input type="file" name="photo"
                                        class="form-control-file @error('photo') is-invalid @enderror">
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                                    @error('photo')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="role_id">Role</label>
                                    <select name="role_id" class="form-control @error('role_id') is-invalid @enderror"
                                        required>
                                        <option value="">-- Pilih Role --</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                {{ $role->nama_role }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
