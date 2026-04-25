@extends('layout')

@section('content')

<div class="row justify-content-center">
<div class="col-md-8">

<div class="card shadow border-0">
<div class="card-body p-4">

<h5 class="fw-bold mb-3">Tambah Data Pasien Baru</h5>
<p class="text-muted">Isi data pasien dengan lengkap</p>

<form action="/patients" method="POST">
@csrf

<div class="row">

<div class="col-md-6 mb-3">
<label>NIK</label>
<input type="text" name="nik" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Nama Lengkap</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Tanggal Lahir</label>
<input type="date" name="birth_date" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Jenis Kelamin</label>
<select name="gender" class="form-control">
<option value="male">Laki-laki</option>
<option value="female">Perempuan</option>
</select>
</div>

<div class="col-md-12 mb-3">
<label>Alamat</label>
<textarea name="address" class="form-control"></textarea>
</div>

<div class="col-md-6 mb-3">
<label>No. Telepon</label>
<input type="text" name="phone" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Riwayat Diabetes</label>
<select name="diabetes_history" class="form-control">
<option value="none">Tidak Ada</option>
<option value="family">Ada (Keluarga)</option>
<option value="personal">Ada (Pribadi)</option>
</select>
</div>

</div>

<div class="d-flex justify-content-between mt-3">
<a href="/patients" class="btn btn-light">Batal</a>
<button class="btn btn-primary px-4">Simpan Data</button>
</div>

</form>

</div>
</div>

</div>
</div>

@endsection