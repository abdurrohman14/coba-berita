<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Berita</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <!-- Tambah Berita Form -->
        <h2>Tambah Berita</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- @dd($categoryBerita) --}}
        <div class="form-group row mt-3">
            <label class="col-sm-3 col-form-label">Kategori Berita</label>
            <div class="col-sm-9">
                <select class="form-control" name="category_berita_id" required>
                    <option>== Pilih ==</option>
                    @foreach ($categoryBerita as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="photo">photo</label>
            <input type="file" class="form-control" id="photo" name="photo" placeholder="Masukkan gambar">
        </div>
        <div class="form-group">
            <label for="title">title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Masukkan judul berita">
        </div>
        <div class="form-group">
            <label for="body">body Berita</label>
            <textarea class="form-control" id="body" rows="3" name="body" placeholder="Masukkan body berita"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Berita</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
