@extends('layouts.app')
@section('content')
    <div class="col-12 col-md-12 col-lg-7">
        <div class="card">
            <form method="POST" action="{{ route('pimpinan.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-header">
                    <h4>Edit Profile</h4>
                </div>
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="form-group">
                        <label>Foto Profil</label><br>
                        @if ($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" width="100" class="mb-2">
                        @endif
                        <input type="file" name="photo" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}"
                            class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Password (kosongkan jika tidak ingin diubah)</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
