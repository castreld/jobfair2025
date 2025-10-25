@csrf
<div class="mb-4">
    <label for="name" class="block mb-2">Nama Posisi</label>
    <input type="text" name="name" id="name" class="w-full px-3 py-2 bg-gray-700 rounded @error('name') border border-red-500 @enderror" value="{{ old('name', $position->name) }}" required>
    @error('name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

@php
    $hasEducation = old('education_toggle', $position->minimum_education ? 'ada' : 'tidak');
    $hasMajors = old('majors_toggle', $position->majors->count() > 0 ? 'ada' : 'tidak');
@endphp

<div class="mb-4 p-4 border border-gray-700 rounded">
    <label class="block mb-2">Minimal Pendidikan</label>
    <div class="flex space-x-4">
        <label class="flex items-center">
            <input type="radio" name="education_toggle" value="ada" class="mr-2" 
                   onchange="toggleWrapper('education-wrapper', true)" {{ $hasEducation == 'ada' ? 'checked' : '' }}>
            Ada minimal pendidikan
        </label>
        <label class="flex items-center">
            <input type="radio" name="education_toggle" value="tidak" class="mr-2" 
                   onchange="toggleWrapper('education-wrapper', false)" {{ $hasEducation == 'tidak' ? 'checked' : '' }}>
            Tidak ada minimal pendidikan
        </label>
    </div>
    @error('education_toggle') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

    <div id="education-wrapper" class="mt-4" style="{{ $hasEducation == 'ada' ? '' : 'display: none;' }}">
        <label for="minimum_education" class="block mb-2">Pilih Pendidikan</label>
        <select name="minimum_education" id="minimum_education" class="w-full px-3 py-2 bg-gray-700 rounded @error('minimum_education') border border-red-500 @enderror">
            <option value="">Pilih Pendidikan Minimal</option>
            @foreach($education_levels as $level)
                <option value="{{ $level }}" {{ old('minimum_education', $position->minimum_education) == $level ? 'selected' : '' }}>
                    {{ $level }}
                </option>
            @endforeach
        </select>
        @error('minimum_education')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mb-4 p-4 border border-gray-700 rounded">
    <label class="block mb-2">Jurusan Spesifik</label>
    <div class="flex space-x-4">
        <label class="flex items-center">
            <input type="radio" name="majors_toggle" value="ada" class="mr-2" 
                   onchange="toggleWrapper('majors-wrapper', true)" {{ $hasMajors == 'ada' ? 'checked' : '' }}>
            Ada jurusan spesifik
        </label>
        <label class="flex items-center">
            <input type="radio" name="majors_toggle" value="tidak" class="mr-2" 
                   onchange="toggleWrapper('majors-wrapper', false)" {{ $hasMajors == 'tidak' ? 'checked' : '' }}>
            Tidak ada jurusan spesifik
        </label>
    </div>
    @error('majors_toggle') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

    <div id="majors-wrapper" class="mt-4" style="{{ $hasMajors == 'ada' ? '' : 'display: none;' }}">
        <label for="majors" class="block mb-2">Jurusan yang Dibutuhkan</label>
        <select name="majors[]" id="majors" multiple="multiple" class="w-full @error('majors') border border-red-500 @enderror">
            @php
                $selectedMajors = old('majors', $position->majors->pluck('id')->toArray());
            @endphp
            @foreach($majors as $major)
                <option value="{{ $major->id }}" {{ in_array($major->id, $selectedMajors) ? 'selected' : '' }}>
                    {{ $major->name }}
                </option>
            @endforeach
        </select>
        <p class="text-xs text-gray-400 mt-1">Bisa cari dan pilih lebih dari satu.</p>
        @error('majors')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="flex justify-end">
    <a href="{{ route('admin.companies.positions.index', $company) }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
        Batal
    </a>
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        {{ $submitText ?? 'Simpan' }}
    </button>
</div>

<script>
    function toggleWrapper(wrapperId, show) {
        const wrapper = document.getElementById(wrapperId);
        if (show) {
            wrapper.style.display = 'block';
        } else {
            wrapper.style.display = 'none';
        }
    }
</script>