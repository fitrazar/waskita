@section('title', 'Materi')

<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-form method="GET" action="{{ route('material') }}">
                <x-input.text-input type="search" name="search" placeholder="Cari..." :value="$search" />
                <x-button.primary-button type="submit">Cari</x-button.primary-button>
            </x-form>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 grid-cols-1 gap-6 p-4">
                @foreach ($materials as $material)
                    <a href="{{ url('/storage/material/file/' . $material->file) }}" target="_blank">
                        <x-card.card-image image='storage/material/cover/{{ $material->cover }}'
                            title="{{ $material->title }}">
                            <p class="text-justify">{{ $material->excerpt }}</p>
                            <div class="badge badge-secondary">{{ $material->type == 0 ? 'PPT' : 'Artikel' }}</div>
                        </x-card.card-image>
                    </a>
                @endforeach
            </div>
            <div class="join">
                {{ $materials->appends(['search' => $search])->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
