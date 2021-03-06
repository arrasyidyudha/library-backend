<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book') }}
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            // AJAX DataTable
            var datatable = $('#crudTable').DataTable({
                ajax: {
                    url: '{!! url()->current() !!}',
                },
                columns: [
                    { data: 'id', name: 'id', width: '5%',  render: function (data, type, row, meta) {
            return meta.row + 1;
       }},
                    { data: 'code', name: 'code' },
                    { data: 'title', name: 'title' },
                    { data: 'author', name: 'author' },
                    { data: 'publisher', name: 'publisher' },
                    { data: 'year', name: 'year' },
                    { data: 'category.name', name: 'category.name' },
                    { data: 'description', name: 'description',  width: '20%' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '15%'
                    },
                   
                ],
            });
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('dashboard.book.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                    + Add book 
                </a>
            </div>
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="crudTable">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publisher</th>
                           
                            <th>Year</th>
                            <th>Kategori</th>
                            <th>Description</th>
                            <th>Aksi</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
