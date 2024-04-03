<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Berita</title>
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
          <a class="nav-link" href="#">Berita</a>
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
  <!-- Tampilkan Data Berita -->
  <h2>Data Berita</h2>
  @if(count($berita) > 0)
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Kategori Berita</th>
        <th scope="col">Gambar</th>
        <th scope="col">Judul</th>
        <th scope="col">Slug</th>
        {{-- <th scope="col">Isi</th> --}}
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($berita as $key => $br)
      <tr>
        {{-- @dd($br) --}}
        <td>{{ $key + 1 }}</td>
        <th>{{ $br->categoryBerita->name }}</th>
        <td><img src="{{ asset('storage/' . $br->photo) }}" alt="Gambar Berita" width="100px"></td>
        <td>{{ $br->title }}</td>
        <td>{{ $br->slug }}</td>
        {{-- <td>{!! $br->body !!}</td> --}}
        <td>
          <a href="{{ route('berita.show', $br->id) }}" class="btn btn-info btn-sm">Detail</a>
          <a href="{{ route('berita.edit', $br->id) }}" type="button" class="btn btn-primary btn-sm">Edit</a>
          <form action="{{ route('berita.delete', $br->id) }}" method="GET" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @else
  <p>Tidak ada berita yang tersedia.</p>
  @endif
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
