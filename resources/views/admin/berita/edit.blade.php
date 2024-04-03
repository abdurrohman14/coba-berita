<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Berita</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="form-group">
      <label for="category_berita_id">Kategori Berita</label>
      <select name="category_berita_id" id="category_berita_id" class="form-control">
          @foreach ($categoryBerita as $id => $name)
              <option value="{{ $id }}" {{ $id == $berita->category_berita_id ? 'selected' : '' }}>{{ $name }}</option>
          @endforeach
      </select>
  </div>
    <div class="form-group">
      <label for="photo">Gambar Berita:</label>
      <input type="file" class="form-control-file" id="photo" name="photo">
      <img src="{{ asset('storage/' . $berita->photo) }}" alt="Gambar Berita" style="max-width: 200px;">
    </div>
    <div class="form-group">
      <label for="title">Judul:</label>
      <input type="text" class="form-control" id="title" name="title" value="{{ $berita->title }}">
    </div>
    <div class="form-group">
      <label for="body">Isi Berita:</label>
      <textarea class="form-control" id="body" name="body" rows="5">{{ $berita->body }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
