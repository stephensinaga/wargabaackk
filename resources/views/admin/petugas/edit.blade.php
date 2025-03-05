@extends('layouts.app')

@section('contents')
    <h2>Edit Petugas</h2>

    <form action="{{ route('admin.petugas.update', $petugas->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama:</label>
            <input type="text" name="name" class="form-control" value="{{ $petugas->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $petugas->email }}" required>
        </div>

        <div class="mb-3">
            <label>Password Baru (Opsional):</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password:</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('admin.petugas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
