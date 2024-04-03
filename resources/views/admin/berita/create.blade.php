<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Berita</title>
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
        <div class="form-group row mt-3">
            <label for="photo" class="col-sm-3 col-form-label">photo</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" id="photo" name="photo" placeholder="Masukkan gambar" accept=".jpg,.png,.jpeg,.gif">
            </div>
        </div>
        <div class="form-group row mt-3">
            <label for="title" class="col-sm-3 col-form-label">title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="title" name="title" placeholder="">
            </div>
        </div>
        <div class="form-group row mt-3">
            <label for="slug" class="col-sm-3 col-form-label">slug</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="slug" name="slug" placeholder="">
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
        
        <button type="submit" class="btn btn-primary" style="float: right;">Tambah Berita</button>
        </form>
    </div>

    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');
      
        title.addEventListener('change', function() {
         fetch('/berita/create/checkSlug?title=' + title.value, {
          method: 'GET'
         }).then(response => response.json()).then(data => slug.value = data.slug);
        });
       </script>

    <script>
        document.addEventListener('trix-file-accept', function(event) {
        if (event.file) {
            uploadFile(event.file);
        }
    });

    function uploadFile(file) {
        var form = new FormData();
        form.append('file', file);

        var csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error('CSRF token meta tag not found');
            return;
        }

        fetch('{!! route("upload") !!}', {
            method: 'POST',
            body: form,
            headers: {
                'X-CSRF-TOKEN': csrfToken.getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.url) {
            var imageUrl = data.url;

            // Sisipkan gambar ke dalam konten editor Trix
            var editor = document.querySelector("trix-editor");
            editor.editor.insertHTML(`<img src="${imageUrl}">`);
        } else {
            console.error('URL gambar tidak tersedia dalam respons JSON');
        }
    })};
    </script>

</body>
</html>
