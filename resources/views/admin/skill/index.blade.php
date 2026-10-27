<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Skill</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Kelola Data Skill</h2>
            <div class="space-x-3 text-sm">
                <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:underline">&larr; Edit Profil</a>
                <a href="{{ route('experience.index') }}" class="text-blue-600 hover:underline">Kelola Pengalaman &rarr;</a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <!-- Form Tambah / Edit Skill -->
        <form action="{{ isset($skill) ? route('skill.update', $skill->id) : route('skill.store') }}" method="POST" class="mb-8 p-4 bg-gray-50 rounded border">
            @csrf
            @if(isset($skill))
                @method('PUT')
            @endif

            <h3 class="font-bold mb-3">{{ isset($skill) ? 'Edit Skill' : 'Tambah Skill Baru' }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1">Nama Skill</label>
                    <input type="text" name="nama_skill" value="{{ isset($skill) ? $skill->nama_skill : '' }}" placeholder="Contoh: Laravel, UI/UX" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Tingkat Keahlian (%)</label>
                    <input type="number" name="tingkat_keahlian" value="{{ isset($skill) ? $skill->tingkat_keahlian : '' }}" min="1" max="100" placeholder="85" class="w-full border p-2 rounded" required>
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 font-semibold">
                        {{ isset($skill) ? 'Update' : 'Simpan' }}
                    </button>
                    @if(isset($skill))
                        <a href="{{ route('skill.index') }}" class="bg-gray-400 text-white py-2 px-4 rounded hover:bg-gray-500 font-semibold">Batal</a>
                    @endif
                </div>
            </div>
        </form>

        <!-- Tabel Daftar Skill -->
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b bg-gray-100">
                    <th class="p-3">Nama Skill</th>
                    <th class="p-3">Persentase</th>
                    <th class="p-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($skills as $item)
                    <tr class="border-b">
                        <td class="p-3 font-semibold">{{ $item->nama_skill }}</td>
                        <td class="p-3">{{ $item->tingkat_keahlian }}%</td>
                        <td class="p-3 text-right space-x-2">
                            <a href="{{ route('skill.edit', $item->id) }}" class="text-yellow-600 hover:underline text-sm font-semibold">Edit</a>
                            <form action="{{ route('skill.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus skill ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">Belum ada skill yang ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
