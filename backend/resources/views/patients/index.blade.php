@extends('layout')

@section('content')

<style>
    .bg-blue-600 { background-color: #2563eb !important; color: white; border: none; }
    .bg-blue-600:hover { background-color: #1d4ed8 !important; }
    
    .badge-soft-red { background-color: #fee2e2; color: #b91c1c; font-weight: 500; }
    .badge-soft-yellow { background-color: #fef3c7; color: #b45309; font-weight: 500; }
    .badge-soft-green { background-color: #d1fae5; color: #047857; font-weight: 500; }
    
    .card { border-radius: 12px; }
    .table th { font-weight: 600; color: #4b5563; font-size: 0.875rem; text-transform: capitalize; }
    .table td { font-size: 0.875rem; color: #1f2937; vertical-align: middle; }
    
    /* Input Search icon di dalam */
    .search-wrapper { position: relative; }
    .search-wrapper .bi-search {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }
    .search-wrapper input {
        padding-left: 40px;
        border-radius: 8px;
    }

    /* Tombol Aksi Hantu (Ghost Button) */
    .btn-ghost { background: transparent; border: none; padding: 6px 10px; border-radius: 6px; }
    .btn-ghost:hover { background: #f3f4f6; }
</style>

<div class="d-flex justify-content-between align-items-end mb-4">
    <div>
        <h3 class="fw-bold mb-1 text-dark">Data Pasien</h3>
        <p class="text-secondary mb-0" style="font-size: 15px;">Kelola data pasien Posbindu</p>
    </div>

    <button type="button" class="btn bg-blue-600 px-3 py-2 d-flex align-items-center gap-2 rounded" data-bs-toggle="modal" data-bs-target="#addPatientModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
        Tambah Pasien
    </button>
</div>

<div class="row g-4 mb-4">
<div class="col-lg-9">
        <div class="card border-0 shadow-sm p-3 h-100 d-flex justify-content-center">
            <form action="/patients" method="GET" class="search-wrapper m-0">
                <i class="bi bi-search"></i>
                <input type="text" class="form-control" name="search" placeholder="Cari berdasarkan nama atau NIK..." value="{{ request('search') }}">
                
                <button type="submit" class="d-none"></button>
            </form>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card border-0 shadow-sm p-3 h-100">
            <p class="text-secondary mb-1" style="font-size: 14px;">Total Pasien</p>
            <h3 class="fw-bold text-dark mb-0">{{ count($patients) }}</h3>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm p-0 mb-4">
    <div class="card-header bg-white border-bottom p-3">
        <h6 class="fw-bold text-dark mb-0">Daftar Pasien</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="border-bottom">
                    <tr>
                        <th class="border-0 px-4 py-3">NIK</th>
                        <th class="border-0 py-3">Nama</th>
                        <th class="border-0 py-3">Usia</th>
                        <th class="border-0 py-3">Jenis Kelamin</th>
                        <th class="border-0 py-3">Telepon</th>
                        <th class="border-0 py-3">Riwayat Diabetes</th>
                        <th class="border-0 px-4 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($patients as $p)
                <tr>
                    <td class="px-4 py-3 text-secondary">{{ $p->nik }}</td>
                    <td class="py-3 fw-medium text-dark">{{ $p->name }}</td>
                    <td class="py-3 text-secondary">{{ $p->birth_date ? \Carbon\Carbon::parse($p->birth_date)->age . ' tahun' : '-' }}</td>
                    <td class="py-3 text-secondary">{{ $p->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td class="py-3 text-secondary">{{ $p->phone ?? '-' }}</td>
                    
                    <td class="py-3">
                        @if($p->diabetes_history == 'personal')
                            <span class="badge badge-soft-red px-3 py-2 rounded-pill">Ada (Pribadi)</span>
                        @elseif($p->diabetes_history == 'family')
                            <span class="badge badge-soft-yellow px-3 py-2 rounded-pill">Ada (Keluarga)</span>
                        @else
                            <span class="badge badge-soft-green px-3 py-2 rounded-pill">Tidak Ada</span>
                        @endif
                    </td>

                    <td class="px-4 py-3">
                        <div class="d-flex gap-1">
                            <a href="/patients/{{ $p->id }}/edit" class="btn-ghost">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg>
                            </a>

                            <form action="/patients/{{ $p->id }}" method="POST" class="m-0 p-0" onsubmit="return confirm('Yakin ingin menghapus pasien ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-ghost">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        Tidak ada data pasien yang ditemukan
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold" id="addPatientModalLabel">Tambah Data Pasien Baru</h5>
                    <p class="text-secondary" style="font-size: 14px;">Isi formulir di bawah ini untuk menambahkan data pasien baru ke sistem</p>
                </div>
                <button type="button" class="btn-close mb-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="/patients" method="POST">
                @csrf
                <div class="modal-body pt-2">
                    <div class="row g-3">
                        
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 14px;">NIK</label>
                            <input type="text" name="nik" class="form-control" placeholder="3201012345678901" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 14px;">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 14px;">Tanggal Lahir</label>
                            <input type="date" name="birth_date" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 14px;">Jenis Kelamin</label>
                            <select name="gender" class="form-select" required>
                                <option value="" selected disabled>Pilih jenis kelamin</option>
                                <option value="male">Laki-laki</option>
                                <option value="female">Perempuan</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size: 14px;">Alamat</label>
                            <input type="text" name="address" class="form-control" placeholder="Masukkan alamat lengkap" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 14px;">No. Telepon</label>
                            <input type="text" name="phone" class="form-control" placeholder="081234567890" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 14px;">Riwayat Diabetes</label>
                            <select name="diabetes_history" class="form-select" required>
                                <option value="" selected disabled>Pilih riwayat</option>
                                <option value="none">Tidak Ada</option>
                                <option value="family">Ada (Keluarga)</option>
                                <option value="personal">Ada (Pribadi)</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0 mt-3 d-flex gap-2">
                    <button type="submit" class="btn bg-blue-600 flex-fill">Simpan Data</button>
                    <button type="button" class="btn btn-outline-secondary flex-fill" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection