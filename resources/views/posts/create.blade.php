<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Post - Laravel Joki</title>

  <!-- Bootstrap, Tailwind, Lucide -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <style>
    body {
      background: linear-gradient(to bottom, #f9fafb, #e5e7eb);
      font-family: 'Inter', sans-serif;
    }

    .card-custom {
      border-radius: 1rem;
      background: white;
      padding: 2rem;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    .form-control {
      border-radius: 0.5rem;
      padding: 0.75rem;
      border: 1px solid #d1d5db;
    }

    .form-control:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }

    label {
      font-weight: 600;
      color: #374151;
      margin-bottom: 0.5rem;
    }

    .image-preview {
      max-width: 200px;
      height: auto;
      border-radius: 0.5rem;
      object-fit: cover;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      margin-top: 0.75rem;
    }

    .btn-primary, .btn-warning {
      border-radius: 0.5rem;
      padding: 0.65rem 1.3rem;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .btn-primary {
      background-color: #3b82f6;
      border: none;
    }

    .btn-primary:hover {
      background-color: #2563eb;
    }

    .btn-warning {
      background-color: #f59e0b;
      border: none;
    }

    .btn-warning:hover {
      background-color: #d97706;
    }

    .alert-danger {
      margin-top: 0.5rem;
    }
  </style>
</head>
<body class="min-h-screen">

  <div class="container mt-5 mb-5">
    <div class="card-custom">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">📝 Tambah Post Baru</h2>

      <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
          <label for="image">Gambar</label>
          <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="imageInput" accept="image/*">
          <img id="imagePreview" class="image-preview" style="display: none;">
          @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="title">Judul</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Masukkan Judul Post">
          @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="content">Konten</label>
          <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="6" placeholder="Masukkan Konten Post">{{ old('content') }}</textarea>
          @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary">
            <i data-lucide="save"></i> Simpan
          </button>
          <button type="reset" class="btn btn-warning">
            <i data-lucide="rotate-ccw"></i> Reset
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('content', {
      height: 300,
      toolbar: 'Standard'
    });

    lucide.createIcons();

    // Gambar preview saat upload
    document.getElementById('imageInput').addEventListener('change', function(event) {
      const file = event.target.files[0];
      const preview = document.getElementById('imagePreview');
      if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
      } else {
        preview.style.display = 'none';
        preview.src = '';
      }
    });
  </script>
</body>
</html>
