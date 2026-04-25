@extends('layout')

@section('content')

<style>
    /* Text & Backgrounds */
    .text-gray-500 { color: #6b7280; }
    .text-gray-600 { color: #4b5563; }
    .text-gray-900 { color: #111827; }
    
    .bg-blue-50 { background-color: #eff6ff; }
    .bg-blue-100 { background-color: #dbeafe !important; }
    .text-blue-600 { color: #2563eb !important; }
    .text-blue-700 { color: #1d4ed8 !important; }
    
    .bg-purple-100 { background-color: #f3e8ff !important; }
    .text-purple-600 { color: #9333ea !important; }
    .text-purple-700 { color: #7e22ce !important; }
    
    .bg-green-100 { background-color: #d1fae5 !important; }
    .text-green-600 { color: #16a34a !important; }
    .text-green-700 { color: #15803d !important; }

    /* Cards & Components */
    .card-ui { background: white; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); transition: all 0.2s ease; display: flex; flex-direction: column;}
    .card-ui:hover { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); transform: translateY(-2px); }
    
    /* Buttons */
    .btn-blue { background-color: #2563eb; color: white; font-weight: 500; border-radius: 6px; padding: 8px 16px; border: none; transition: background 0.2s; }
    .btn-blue:hover { background-color: #1d4ed8; color: white;}
    .btn-outline-ui { border: 1px solid #e5e7eb; background: transparent; color: #374151; padding: 8px 16px; border-radius: 6px; font-weight: 500; transition: background 0.2s;}
    .btn-outline-ui:hover { background-color: #f3f4f6; }

    /* Tabs (Shadcn UI Style) */
    .custom-tabs { background: #f1f5f9; padding: 4px; border-radius: 8px; display: inline-flex; width: 100%; max-width: 600px; margin-bottom: 24px; }
    .custom-tabs .nav-link { flex: 1; text-align: center; color: #64748b; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 16px; transition: all 0.2s; border: none; background: transparent; cursor: pointer;}
    .custom-tabs .nav-link:hover { color: #0f172a; }
    .custom-tabs .nav-link.active { background: white; color: #0f172a; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    
    /* Badge Category */
    .badge-cat { padding: 4px 10px; border-radius: 9999px; font-size: 12px; font-weight: 600; display: inline-block; text-transform: capitalize;}
</style>

@php
    // Dummy perhitungan statistik agar UI terisi (Bisa disesuaikan jika kolom category sudah ada di DB)
    $totalArtikel = $data->where('category', 'artikel')->count();
    $totalVideo = $data->where('category', 'video')->count();
    // Jika data tidak ada kategori, asumsikan semua artikel untuk statistik
    if($totalArtikel == 0 && count($data) > 0) $totalArtikel = count($data); 
@endphp

<div class="container-fluid p-0">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-gray-900 m-0" style="font-size: 30px;">Edukasi Kesehatan</h1>
            <p class="text-gray-500 mt-1" style="font-size: 15px;">Kelola dan bagikan materi edukasi diabetes</p>
        </div>
        <button class="btn-blue d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addMateriModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Tambah Materi
        </button>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card-ui p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-gray-600 m-0" style="font-size: 14px;">Total Materi</p>
                        <p class="text-gray-900 m-0 mt-2 fw-bold" style="font-size: 30px;">{{ count($data) }}</p>
                    </div>
                    <div class="bg-blue-100 p-2 rounded-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-ui p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-gray-600 m-0" style="font-size: 14px;">Artikel</p>
                        <p class="text-gray-900 m-0 mt-2 fw-bold" style="font-size: 30px;">{{ $totalArtikel }}</p>
                    </div>
                    <div class="bg-blue-100 p-2 rounded-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-ui p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-gray-600 m-0" style="font-size: 14px;">Video</p>
                        <p class="text-gray-900 m-0 mt-2 fw-bold" style="font-size: 30px;">{{ $totalVideo }}</p>
                    </div>
                    <div class="bg-purple-100 p-2 rounded-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-purple-600"><polygon points="23 7 16 12 23 17 23 7"/><rect width="15" height="14" x="1" y="5" rx="2" ry="2"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-ui p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-gray-600 m-0" style="font-size: 14px;">Total Views</p>
                        <p class="text-gray-900 m-0 mt-2 fw-bold" style="font-size: 30px;">{{ count($data) * 150 }}</p> </div>
                    <div class="bg-green-100 p-2 rounded-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-600"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-tabs">
        <button class="nav-link active" onclick="filterCat('semua', this)">Semua</button>
        <button class="nav-link" onclick="filterCat('artikel', this)">Artikel</button>
        <button class="nav-link" onclick="filterCat('video', this)">Video</button>
        <button class="nav-link" onclick="filterCat('infografis', this)">Infografis</button>
    </div>

    <div class="row g-4" id="materiContainer">
        @forelse($data as $e)
            @php
                // Fallback variabel jika database belum punya kolom-kolom ini
                $kategori = $e->category ?? 'artikel'; // Default artikel
                $tanggal = $e->created_at ? $e->created_at->format('Y-m-d') : date('Y-m-d');
                $views = $e->views ?? rand(50, 300); // Random view statis sementara

                // Penentuan warna & ikon berdasarkan kategori
                $bgColor = $kategori == 'artikel' ? 'bg-blue-100 text-blue-700' : ($kategori == 'video' ? 'bg-purple-100 text-purple-700' : 'bg-green-100 text-green-700');
            @endphp

            <div class="col-md-6 col-lg-4 materi-item" data-category="{{ $kategori }}">
                <div class="card-ui h-100 p-0 border-0 overflow-hidden" style="border: 1px solid #e5e7eb;">
                    <div class="p-4 border-bottom border-gray-100">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="p-2 rounded-3 {{ $bgColor }}">
                                @if($kategori == 'artikel')
                                    <i class="bi bi-file-text fs-5"></i>
                                @elseif($kategori == 'video')
                                    <i class="bi bi-play-btn fs-5"></i>
                                @else
                                    <i class="bi bi-book fs-5"></i>
                                @endif
                            </div>
                            <span class="text-gray-500" style="font-size: 12px;">{{ $tanggal }}</span>
                        </div>
                        <h4 class="fw-bold text-gray-900 m-0" style="font-size: 18px;">{{ $e->title }}</h4>
                    </div>
                    
                    <div class="p-4 d-flex flex-column flex-grow-1">
                        <p class="text-gray-600 mb-4" style="font-size: 14px; line-height: 1.5;">
                            {{ \Illuminate\Support\Str::limit($e->content, 100) }}
                        </p>
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-gray-100">
                                <span class="badge-cat {{ $bgColor }}">{{ $kategori }}</span>
                                <span class="text-gray-500" style="font-size: 13px;">{{ $views }} views</span>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <a href="/edukasi/{{ $e->id }}" class="btn-outline-ui w-100 text-center text-decoration-none">
                                    Lihat Detail
                                </a>
                                <button class="btn-blue w-100 d-flex justify-content-center align-items-center gap-2" onclick="alert('Materi {{ $e->title }} berhasil dikirim ke semua pasien!')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" x2="11" y1="2" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                                    Kirim
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12" id="emptyState">
                <div class="card-ui p-5 text-center text-gray-500">
                    <i class="bi bi-journal-x fs-1 mb-2 d-block"></i>
                    Belum ada materi edukasi yang ditambahkan
                </div>
            </div>
        @endforelse
    </div>

</div>

<div class="modal fade" id="addMateriModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold text-dark">Tambah Materi Edukasi Baru</h5>
                    <p class="text-secondary mb-0" style="font-size: 14px;">Upload dan tambahkan materi edukasi baru untuk pasien</p>
                </div>
                <button type="button" class="btn-close mb-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="/edukasi" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pt-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 14px;">Judul Materi</label>
                        <input type="text" name="title" class="form-control p-2" placeholder="Masukkan judul materi edukasi" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 14px;">Kategori</label>
                        <select name="category" class="form-select p-2" required>
                            <option value="artikel">Artikel</option>
                            <option value="video">Video</option>
                            <option value="infografis">Infografis</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 14px;">Deskripsi / Konten</label>
                        <textarea name="content" class="form-control p-2" rows="4" placeholder="Deskripsi singkat tentang materi" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 14px;">Upload File (Opsional)</label>
                        <input type="file" name="file" class="form-control p-2" accept=".pdf,.doc,.docx,.jpg,.png,.mp4">
                    </div>
                </div>
                
                <div class="modal-footer border-top-0 pt-0 d-flex gap-2">
                    <button type="submit" class="btn-blue flex-fill">Simpan Materi</button>
                    <button type="button" class="btn-outline-ui flex-fill text-center m-0" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function filterCat(kategori, btn) {
        // Update active class on buttons
        document.querySelectorAll('.custom-tabs .nav-link').forEach(el => el.classList.remove('active'));
        btn.classList.add('active');

        // Filter items
        let items = document.querySelectorAll('.materi-item');
        let visibleCount = 0;

        items.forEach(item => {
            if (kategori === 'semua' || item.getAttribute('data-category') === kategori) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Tampilkan placeholder jika kosong
        let emptyState = document.getElementById('emptyState');
        if(emptyState) {
            if (visibleCount === 0 && items.length > 0) {
                emptyState.style.display = 'block';
                emptyState.innerHTML = `<div class="card-ui p-5 text-center text-gray-500">Belum ada materi edukasi untuk kategori ${kategori}</div>`;
            } else {
                emptyState.style.display = 'none';
            }
        }
    }
</script>

@endsection