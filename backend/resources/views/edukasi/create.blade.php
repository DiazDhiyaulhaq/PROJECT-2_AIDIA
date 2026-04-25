@extends('layout')

@section('content')

<h3>Tambah Edukasi</h3>

<form method="POST" action="/edukasi">
@csrf

<label>Judul</label>
<input type="text" name="title" class="form-control mb-2">

<label>Konten</label>
<textarea name="content" class="form-control mb-3"></textarea>

<button class="btn btn-success">Simpan</button>

</form>

@endsection