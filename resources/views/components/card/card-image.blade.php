@props(['title', 'image' => null, 'video' => null])

<div {!! $attributes->merge(['class' => 'card bg-base-100 shadow-xl']) !!}>
    <figure>
        @if ($image)
            <img src="{{ asset($image) }}" alt="{{ $title ?? 'alt' }}"
                class="p-4 rounded object-contain w-full max-h-64" />
        @endif
        @if ($video)
            <video controls poster="{{ asset('assets/images/logo.png') }}"
                class="p-4 rounded object-contain w-full max-h-64">
                <source src="{{ asset($video) }}">
                Uppsss
            </video>
            {{-- <video src="{{ asset($video) }}" class="p-4 rounded object-contain w-full max-h-64" controls></video> --}}
        @endif
    </figure>
    <div class="card-body">
        <h2 class="card-title">{{ $title ?? '' }}</h2>
        {{ $slot }}

    </div>
</div>
