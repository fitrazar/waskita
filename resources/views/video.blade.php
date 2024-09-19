@section('title', 'Video Edukasi')

<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-form method="GET" action="{{ route('video') }}">
                <x-input.text-input type="search" name="search" placeholder="Cari..." :value="$search" />
                <x-button.primary-button type="submit">Cari</x-button.primary-button>
            </x-form>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 grid-cols-1 gap-6 p-4">
                @foreach ($videos as $video)
                    <x-card.card-image video='storage/video/{{ $video->video }}' title="{{ $video->title }}">
                        <div class="badge badge-secondary">Video Edukasi</div>
                    </x-card.card-image>
                @endforeach
            </div>
            <div class="join">
                {{ $videos->appends(['search' => $search])->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
