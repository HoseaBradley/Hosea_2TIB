<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengalaman</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-sm">
        <h2 class="text-xl font-bold mb-4">Tambah Pengalaman Baru</h2>
        <form action="{{ route('experience.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium">Judul Project / Perusahaan</label>
                <input type="text" name="judul" placeholder="Contoh: Freelance Interior Designer" class="w-full border rounded p-2 border-gray-300" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Tahun / Periode</label>
                <input type="text" name="tahun" placeholder="Contoh: 2021 - Sekarang" class="w-full border rounded p-2 border-gray-300" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full border rounded p-2 border-gray-300" required></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Foto Project (Opsional)</label>
                <input type="file" name="foto_project" class="w-full border rounded p-2 border-gray-300">
            </div>
            <div class="flex justify-between items-center pt-2">
                <a href="{{ route('experience.index') }}" class="text-gray-500">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Pengalaman</button>
            </div>
        </form>
    </div>
</body>
</html>
