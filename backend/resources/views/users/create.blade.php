@extends('layout')

@section('content')

<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="font-weight-bold">Manajemen Kader</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 font-weight-bold text-primary">Tambah Kader Baru</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="/users">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label font-weight-bold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label font-weight-bold">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="admin@gmail.com" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label font-weight-bold">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="******" required>
                    </div>
                </div>
                <div class="text-right mt-2">
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Simpan Data Kader</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: #212529; color: white;">
                        <tr>
                            <th class="py-3 px-4 text-center">No</th>
                            <th class="py-3 px-4">Nama Kader</th>
                            <th class="py-3 px-4">Email</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="px-4 text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 font-weight-bold">{{ $user->name }}</td>
                            <td class="px-4 text-muted">{{ $user->email }}</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-warning font-weight-bold text-dark shadow-sm">Edit</a>
                                <form action="/users/{{ $user->id }}" method="POST" class="d-inline">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger font-weight-bold shadow-sm" onclick="return confirm('Hapus kader ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada data kader.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection