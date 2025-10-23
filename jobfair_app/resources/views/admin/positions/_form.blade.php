@csrf
<div class="mb-4">
    <label for="name" class="block mb-2">Nama Posisi</label>
    <input type="text" name="name" id="name" class="w-full px-3 py-2 bg-gray-700 rounded @error('name') border border-red-500 @enderror" value="{{ old('name', $position->name ?? '') }}" required>
    @error('name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
<div class="flex justify-end">
    <a href="{{ route('admin.companies.positions.index', $company) }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
        Batal
    </a>
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        {{ $submitText ?? 'Simpan' }}
    </button>
</div>