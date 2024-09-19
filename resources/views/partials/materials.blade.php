@foreach ($materials as $material)
    <a href="{{ url('/storage/material/file/' . $material->file) }}" target="_blank">
        <x-card.card-image image='storage/material/cover/{{ $material->cover }}' title="{{ $material->title }}">
            <p class="text-justify">{{ $material->excerpt }}</p>
            <div class="badge badge-secondary">{{ $material->type == 0 ? 'PPT' : 'Artikel' }}</div>
        </x-card.card-image>
    </a>
@endforeach
