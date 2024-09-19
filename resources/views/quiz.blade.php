@section('title', 'Quiz')

<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.card-default class="static">

                <div class="relative overflow-x-auto mt-5">
                    <table id="quizzes" class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Judul
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Google Form
                                </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </x-card.card-default>
        </div>
    </div>

    <x-slot name="script">
        <script>
            $(document).ready(function() {
                let dataTable = $('#quizzes').DataTable({
                    buttons: [
                        // 'copy', 'excel', 'csv', 'pdf', 'print',
                        'colvis'
                    ],
                    processing: true,
                    search: {
                        return: true
                    },
                    serverSide: true,
                    ajax: {
                        url: '{{ route('quiz') }}',
                    },
                    columns: [{
                            data: null,
                            name: 'no',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                return `
                                <a href="${data.form}" target="_blank"><span class="badge badge-primary">GForm</span></a>
                                `
                            },
                            orderable: false,
                            searchable: false,
                        },
                    ]
                });
            });
        </script>
    </x-slot>
</x-app-layout>
