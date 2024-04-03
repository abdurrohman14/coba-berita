<!-- detail.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita</title>
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

    <div class="container mt-5">
        <h2>Detail Berita</h2>
        <div class="card">
            <div class="card-body">
                <img src="{{ asset('storage/' . $berita->photo) }}" alt="" width="100px">
                <h5 class="card-title">{{ $berita->title }}</h5>
                <p class="card-title">{{ $berita->slug }}</p>
                <p class="card-text">{{ $berita->CategoryBerita->name }}</p>
                <p class="card-text">{!! $berita->body !!}</p>
                <p class="card-text">{{ $berita->created_at->format('Y-m-d') }}</p>
                <a href="{{ route('berita.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
