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
    <div class="container mt-5">
        <h2>Detail Berita</h2>
        <div class="card">
            <div class="card-body">
                <img src="{{ asset('storage/' . $berita->photo) }}" alt="" width="100px">
                <h5 class="card-title">{{ $berita->title }}</h5>
                <p class="card-title">{{ $berita->slug }}</p>
                <p class="card-text">{{ $berita->CategoryBerita->name }}</p>
                <p class="card-text">{{ $berita->body }}</p>
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
