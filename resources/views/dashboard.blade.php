<x-app-layout>
    <div class="flex justify-between items-center flex-wrap">
        <x-input.input-label class="input flex items-center gap-2 rounded-full">
            <div class="bg-secondary-red rounded-full p-2 -ml-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-6 w-6">
                    <path fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <x-input.text-input type="text" class="grow border-0" id="search" placeholder="Jelajahi Halaman..." />
        </x-input.input-label>
        <div class="flex items-center">
            <div class="avatar">
                <div class="w-16 rounded-full">
                    <img src="{{ asset('assets/images/male.png') }}" />
                </div>
            </div>
            @auth
                <div>
                    <h2 class="font-bold ml-3">Nama</h2>
                    <span class="ml-3 text-sm">Admin</span>
                </div>
            @endauth
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <!-- Konten Section -->
            <div class="flex justify-between items-center">
                <div class="flex items-center justify-start">
                    <h2 class="font-bold text-xl mr-4">Konten</h2>
                    <x-input.select-input id="filter"
                        class="border-0 bg-secondary-red rounded-full text-black font-semibold">
                        <option value="" selected disabled>Pilih Konten</option>
                        <option value="All">Semua Konten</option>
                        <option value="PPT">PPT</option>
                        <option value="Artikel">Artikel</option>
                    </x-input.select-input>
                </div>
                <div class="join grid grid-cols-2 bg-secondary-red text-primary-red border-0 materials-pagination">
                    <button class="join-item btn btn-outline prev-btn"
                        data-current="{{ $materials->currentPage() }}">«</button>
                    <button class="join-item btn btn-outline next-btn"
                        data-current="{{ $materials->currentPage() }}">»</button>
                </div>
            </div>

            <!-- Placeholder loading -->
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6 mt-7" id="materials-list">
                <div class="flex justify-center items-center w-full" id="materials-loading">
                    <span class="loading loading-spinner loading-lg text-primary"></span>
                </div>
            </div>

            <!-- Video Section -->
            <div class="flex justify-between items-center pt-16">
                <div class="flex items-center justify-start">
                    <h2 class="font-bold text-xl mr-4">Video Edukasi</h2>
                </div>
                <div class="join grid grid-cols-2 bg-secondary-red text-primary-red border-0 videos-pagination">
                    <button class="join-item btn btn-outline prev-btn"
                        data-current="{{ $videos->currentPage() }}">«</button>
                    <button class="join-item btn btn-outline next-btn"
                        data-current="{{ $videos->currentPage() }}">»</button>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6 mt-7" id="videos-list">
                <div class="flex justify-center items-center w-full" id="videos-loading">
                    <span class="loading loading-spinner loading-lg text-primary"></span>
                </div>
            </div>

        </div>
    </div>

    <x-slot name="script">
        <script>
            $(document).ready(function() {
                let debounceTimer;

                loadMaterials();
                loadVideos();

                $('#filter').on('change', function() {
                    const type = $(this).val();
                    loadMaterials(type);
                });

                $('#search').on('input', function() {
                    clearTimeout(debounceTimer);
                    const searchQuery = $(this).val();

                    debounceTimer = setTimeout(() => {
                        searchContent(searchQuery);
                    }, 500); // Delay 500ms
                });

                function loadMaterials(type = '', page = 1) {
                    $('#materials-list').html($('#materials-loading').show());
                    $.ajax({
                        url: "{{ route('materials.fetch') }}",
                        data: {
                            type: type,
                            page: page
                        },
                        success: function(data) {

                            if (data.materials.length === 0) {
                                $('#materials-list').html(`
                                    <div class="col-span-3">
                                        <div class="card w-full bg-base-100 shadow-xl">
                                            <div class="card-body">
                                                <h2 class="card-title">Data tidak ditemukan</h2>
                                            </div>
                                        </div>
                                    </div>
                                `);
                            } else {
                                $('#materials-list').html(data.materials);
                            }
                            $('.materials-pagination .next-btn').data('current', page);
                            $('.materials-pagination .prev-btn').data('current', page);
                        }
                    });
                }

                function loadVideos(page = 1) {
                    $('#videos-list').html($('#videos-loading').show());
                    $.ajax({
                        url: "{{ route('videos.fetch') }}",
                        data: {
                            page: page
                        },
                        success: function(data) {
                            $('#videos-loading').hide();
                            if (data.videos.length === 0) {
                                $('#videos-list').html(`
                                    <div class="col-span-3">
                                        <div class="card w-full bg-base-100 shadow-xl">
                                            <div class="card-body">
                                                <h2 class="card-title">Data tidak ditemukan</h2>
                                            </div>
                                        </div>
                                    </div>
                                `);
                            } else {
                                $('#videos-list').html(data.videos);
                            }
                            $('.videos-pagination .next-btn').data('current', page);
                            $('.videos-pagination .prev-btn').data('current', page);
                        }
                    });
                }

                function searchContent(query) {
                    $('#materials-list').html($('#materials-loading').show());
                    $('#videos-list').html($('#videos-loading').show());
                    $.ajax({
                        url: "{{ route('search') }}",
                        data: {
                            search: query
                        },
                        success: function(data) {
                            $('#materials-loading').hide();
                            $('#videos-loading').hide();
                            $('#materials-list').html(data.materials);
                            $('#videos-list').html(data.videos);
                        }
                    });
                }

                $(document).on('click', '.materials-pagination .next-btn', function() {
                    let currentPage = $(this).data('current');
                    loadMaterials('', currentPage + 1);
                });

                $(document).on('click', '.materials-pagination .prev-btn', function() {
                    let currentPage = $(this).data('current');
                    if (currentPage > 1) {
                        loadMaterials('', currentPage - 1);
                    }
                });

                $(document).on('click', '.videos-pagination .next-btn', function() {
                    let currentPage = $(this).data('current');
                    loadVideos(currentPage + 1);
                });

                $(document).on('click', '.videos-pagination .prev-btn', function() {
                    let currentPage = $(this).data('current');
                    if (currentPage > 1) {
                        loadVideos(currentPage - 1);
                    }
                });
            });
        </script>
    </x-slot>
</x-app-layout>
