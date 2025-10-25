<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Posisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--multiple {
            background-color: #374151;
            border: 1px solid #4B5563;
            border-radius: 0.375rem;
            color: white;
            min-height: 42px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #4B5563;
            border-color: #6B7280;
            color: white;
            padding-top: 2px;
            padding-bottom: 2px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #D1D5DB;
            margin-right: 5px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: white;
        }
        .select2-container--default .select2-search--inline .select2-search__field {
            color: white;
            margin-top: 7px;
        }
        .select2-dropdown {
            background-color: #374151;
            border-color: #4B5563;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #2563EB;
        }
        .select2-container--default .select2-results__option {
            color: white;
        }
        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #4B5563;
        }
        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            position: relative;
            vertical-align: middle;
            width: 100% !important;
        }
        .select2-container--default .select2-search--inline .select2-search__field {
            width: 100% !important;
        }
    </style>
</head>
<body class="bg-gray-900 text-white">
    <div class="flex-1 p-8">
        <h2 class="text-3xl font-bold mb-8">Edit Posisi: {{ $position->name }}</h2>
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <form action="{{ route('admin.companies.positions.update', [$company, $position]) }}" method="POST">
                @method('PUT')
                @include('admin.positions._form', [
                    'company' => $company,
                    'position' => $position,
                    'majors' => $majors,
                    'education_levels' => $education_levels,
                    'submitText' => 'Perbarui'
                ])
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#majors').select2({
                width: '100%',
                placeholder: "Pilih satu atau lebih jurusan",
                allowClear: true
            });
        });
    </script>
</body>
</html>