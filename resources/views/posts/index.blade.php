<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tugas Laravel - Rivo Kurniawan</title>

  <!-- Bootstrap & Tailwind -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <!-- Toastr -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <style>
    body {
      background: linear-gradient(to bottom, #f9fafb, #e5e7eb);
      font-family: 'Inter', sans-serif;
    }

    .card-custom {
      border-radius: 1rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
      background: white;
      padding: 2rem;
    }

    .btn-add {
      background-color: #10b981;
      color: white;
      font-weight: 600;
      border-radius: 0.5rem;
      padding: 0.6rem 1.2rem;
      transition: all 0.3s ease;
    }

    .btn-add:hover {
      background-color: #059669;
      transform: scale(1.05);
    }

    .table thead {
      background-color: #f3f4f6;
    }

    .table-hover tbody tr:hover {
      background-color: #f9fafb;
    }

    .table td, .table th {
      vertical-align: middle;
    }

    img.thumbnail {
      width: 120px;
      height: 80px;
      object-fit: cover;
      border-radius: 0.5rem;
    }

    .btn-icon {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
    }
  </style>
</head>
<body class="min-h-screen">

  <div class="container mt-5 mb-5">
    <div class="card-custom">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">📚 Daftar Postingan</h2>
        <a href="{{ route('posts.create') }}" class="btn-add btn-icon">
          <i data-lucide="plus-circle" class="w-5 h-5"></i> Tambah Post
        </a>
      </div>

      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>Gambar</th>
              <th>Judul</th>
              <th>Konten</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($posts as $post)
              <tr>
                <td>
                  <img src="{{ Storage::url('public/posts/').$post->image }}" alt="Post Image" class="thumbnail">
                </td>
                <td class="fw-semibold text-gray-800">{{ $post->title }}</td>
                <td class="text-gray-600">{!! Str::limit(strip_tags($post->content), 100) !!}</td>
                <td class="text-center">
                  <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary btn-icon mb-1">
                      <i data-lucide="edit-3" class="w-4 h-4"></i> Edit
                    </a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger btn-icon">
                      <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center text-danger py-4">Data Post belum tersedia.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-4 d-flex justify-content-center">
        {{ $posts->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    lucide.createIcons();

    @if(session()->has('success'))
      toastr.success('{{ session('success') }}', 'Berhasil!', { timeOut: 3000 });
    @elseif(session()->has('error'))
      toastr.error('{{ session('error') }}', 'Gagal!', { timeOut: 3000 });
    @endif
  </script>
</body>
</html>
