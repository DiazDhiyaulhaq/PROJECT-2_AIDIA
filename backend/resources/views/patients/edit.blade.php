@extends('layout')

@section('content')

<div class="row justify-content-center">
<div class="col-md-8">

<div class="card shadow border-0">
<div class="card-body p-4">

<h5 class="fw-bold mb-2">Edit Data Pasien</h5>
<p class="text-muted mb-4">Perbarui data pasien</p>

<form action="/patients/{{ $patient->id }}" method="POST">
@csrf
@method('PUT')

<div class="row">

<!-- NIK -->
<div class="col-md-6 mb-3">
<label class="form-label">NIK</label>
<input type="text" name="nik" class="form-control" value="{{ $patient->nik }}" required>
</div>

<!-- NAMA -->
<div class="col-md-6 mb-3">
<label class="form-label">Nama Lengkap</label>
<input type="text" name="name" class="form-control" value="{{ $patient->name }}" required>
</div>

<!-- TANGGAL LAHIR -->
<div class="col-md-6 mb-3">
<label class="form-label">Tanggal Lahir</label>
<input type="date" name="birth_date" class="form-control" 
value="{{ $patient->birth_date }}">
</div>

<!-- GENDER -->
<div class="col-md-6 mb-3">
<label class="form-label">Jenis Kelamin</label>
<select name="gender" class="form-control">
<option value="male" {{ $patient->gender == 'male' ? 'selected' : '' }}>Laki-laki</option>
<option value="female" {{ $patient->gender == 'female' ? 'selected' : '' }}>Perempuan</option>
</select>
</div>

<!-- ALAMAT -->
<div class="col-md-12 mb-3">
<label class="form-label">Alamat</label>
<textarea name="address" class="form-control">{{ $patient->address }}</textarea>
</div>

<!-- TELEPON -->
<div class="col-md-6 mb-3">
<label class="form-label">No. Telepon</label>
<input type="text" name="phone" class="form-control" value="{{ $patient->phone }}">
</div>

<!-- RIWAYAT -->
<div class="col-md-6 mb-3">
<label class="form-label">Riwayat Diabetes</label>
<select name="diabetes_history" class="form-control">
<option value="none" {{ $patient->diabetes_history == 'none' ? 'selected' : '' }}>Tidak Ada</option>
<option value="family" {{ $patient->diabetes_history == 'family' ? 'selected' : '' }}>Ada (Keluarga)</option>
<option value="personal" {{ $patient->diabetes_history == 'personal' ? 'selected' : '' }}>Ada (Pribadi)</option>
</select>
</div>

</div>

<!-- BUTTON -->
<div class="d-flex justify-content-between mt-3">
<a href="/patients" class="btn btn-light px-4">Batal</a>
<button class="btn btn-primary px-4">Update Data</button>
</div>

</form>

</div>
</div>

</div>
</div>

@endsection