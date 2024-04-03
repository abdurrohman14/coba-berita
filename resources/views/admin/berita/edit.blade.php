<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Berita</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Admin Panel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('berita.index') }}">Berita</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('berita.create') }}">Tambah Berita</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Content -->
<div class="container mt-5">
  <h2>Edit Berita</h2>
  <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Menambahkan ini untuk menentukan method HTTP -->
    @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="form-group row mt-3">
      <label for="category_berita_id" class="col-sm-3 col-form-label">Kategori Berita</label>
      <div class="col-sm-9">
        <select name="category_berita_id" id="category_berita_id" class="form-control">
            @foreach ($categoryBerita as $id => $name)
                <option value="{{ $id }}" {{ $id == $berita->category_berita_id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
      </div>
    </div>
    <div class="form-group row mt-3">
      <label for="photo" class="col-sm-3 col-form-label">Gambar Berita:</label>
      <div class="col-sm-9">
        <input type="file" class="form-control-file" id="photo" name="photo">
        <img src="{{ asset('storage/' . $berita->photo) }}" alt="Gambar Berita" style="max-width: 200px;">
      </div>
    </div>
    <div class="form-group row mt-3">
      <label for="title" class="col-sm-3 col-form-label">Judul:</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="title" name="title" value="{{ $berita->title }}">
      </div>
    </div>
    <div class="form-group row mt-3">
      <label for="slug" class="col-sm-3 col-form-label">Slug:</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="slug" name="slug" value="{{ $berita->slug }}">
      </div>
    </div>
    <div class="form-group row mt-3">
      <label class="col-sm-3 col-form-label">Isi</label>
      <div class="col-sm-9">
          <input id="body" type="hidden" name="body">
          <trix-editor input="body" data-direct-upload-url="{{ route('upload') }}" data-persisted>
          </trix-editor>
      </div>
  </div>
    <button type="submit" class="btn btn-primary" style="float: right;">Update</button>
  </form>
</div>

<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
