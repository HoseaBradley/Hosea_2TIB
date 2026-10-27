<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-sm">
        <div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-bold">Kelola Data Profil</h2>
    <div class="space-x-3 text-sm">
        <a href="{{ route('skill.index') }}" class="text-blue-600 hover:underline">Kelola Skill &rarr;</a>
        <a href="{{ route('experience.index') }}" class="text-blue-600 hover:underline">Kelola Pengalaman &rarr;</a>
    </div>
</div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', $profile->nama) }}" class="w-full border rounded p-2 border-gray-300" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Profesi / Jurusan</label>
                <input type="text" name="profesi" value="{{ old('profesi', $profile->profesi) }}" class="w-full border rounded p-2 border-gray-300" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Bio / Deskripsi Profil</label>
                <textarea name="bio" rows="3" class="w-full border rounded p-2 border-gray-300" required>{{ old('bio', $profile->bio) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Website / Medsos</label>
                <input type="text" name="website" value="{{ old('website', $profile->website) }}" placeholder="www.domain.com" class="w-full border rounded p-2 border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Foto Profil Saat Ini</label>
                @if($profile->foto_profil)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $profile->foto_profil) }}" class="w-24 h-24 object-cover rounded-full mb-1">
                        <label class="text-xs text-red-600 inline-flex items-center">
                            <input type="checkbox" name="hapus_foto" value="1" class="mr-1"> Hapus Foto Profil
                        </label>
                    </div>
                @endif
                <input type="file" name="foto_profil" class="w-full border rounded p-2 border-gray-300">
            </div>
            <div class="pt-2 flex justify-between items-center">
                <a href="{{ route('portofolio.public') }}" class="text-gray-500 hover:underline">Lihat Portofolio Utama</a>
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded">Simpan Profil</button>
            </div>
        </form>
    </div>
</body>
</html>
