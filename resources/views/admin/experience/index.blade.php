<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengalaman</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Kelola Data Pengalaman</h2>
            <div class="space-x-3 text-sm">
                <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:underline">&larr; Edit Profil</a>
                <a href="{{ route('skill.index') }}" class="text-blue-600 hover:underline">Kelola Skill &rarr;</a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <!-- Form Tambah / Edit Pengalaman -->
        <form action="{{ isset($experience) ? route('experience.update', $experience->id) : route('experience.store') }}" method="POST" enctype="multipart/form-data" class="mb-8 p-4 bg-gray-50 rounded border">
            @csrf
            @if(isset($experience))
                @method('PUT')
            @endif

            <h3 class="font-bold mb-3">{{ isset($experience) ? 'Edit Pengalaman' : 'Tambah Pengalaman Baru' }}</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold mb-1">Judul / Posisi / Proyek</label>
                    <input type="text" name="judul" value="{{ isset($experience) ? $experience->judul : '' }}" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Tahun (contoh: 2022 - 2024)</label>
                    <input type="text" name="tahun" value="{{ isset($experience) ? $experience->tahun : '' }}" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Deskripsi</label>
                    <textarea name="deskripsi" class="w-full border p-2 rounded" rows="3" required>{{ isset($experience) ? $experience->deskripsi : '' }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Foto Project (Opsional)</label>
                    @if(isset($experience) && $experience->foto_project)
                        <img src="{{ asset('storage/' . $experience->foto_project) }}" class="h-16 mb-2 rounded border">
                    @endif
                    <input type="file" name="foto_project" class="w-full border p-2 rounded bg-white">
                </div>
                <div class="flex space-x-2">
                    <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded hover:bg-blue-700 font-semibold">
                        {{ isset($experience) ? 'Update Pengalaman' : 'Simpan Pengalaman' }}
                    </button>
                    @if(isset($experience))
                        <a href="{{ route('experience.index') }}" class="bg-gray-400 text-white py-2 px-6 rounded hover:bg-gray-500 font-semibold">Batal</a>
                    @endif
                </div>
            </div>
        </form>

        <!-- Tabel Daftar Pengalaman -->
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b bg-gray-100">
                    <th class="p-3">Foto</th>
                    <th class="p-3">Judul</th>
                    <th class="p-3">Tahun</th>
                    <th class="p-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($experiences as $item)
                    <tr class="border-b">
                        <td class="p-3">
                            @if($item->foto_project)
                                <img src="{{ asset('storage/' . $item->foto_project) }}" class="w-12 h-12 object-cover rounded">
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                        <td class="p-3 font-semibold">{{ $item->judul }}</td>
                        <td class="p-3">{{ $item->tahun }}</td>
                        <td class="p-3 text-right space-x-2">
                            <a href="{{ route('experience.edit', $item->id) }}" class="text-yellow-600 hover:underline text-sm font-semibold">Edit</a>
                            <form action="{{ route('experience.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">Belum ada pengalaman ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
