@foreach ($videos as $video)
    <x-card.card-image video='storage/video/{{ $video->video }}' title="{{ $video->title }}">
        <div class="badge badge-secondary">Video Edukasi</div>
    </x-card.card-image>
@endforeach
