@section('title', 'Kontak')

<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col justify-center items-center">
            <div>
                <img src="{{ asset('storage/' . $contact->logo) }}" alt="Logo" class="w-44 h-44">
            </div>
            <div class="stats shadow">
                <div class="stat place-items-center">
                    <div class="stat-title">Nama Usaha</div>
                    <div class="stat-value text-lg">{{ $contact->name }}</div>
                </div>

                <div class="stat place-items-center">
                    <div class="stat-title">No Telpon</div>
                    <div class="stat-value text-lg">{{ $contact->phone }}</div>
                </div>

                <div class="stat place-items-center">
                    <div class="stat-title">Alamat</div>
                    <div class="stat-value text-lg">{{ $contact->address }}</div>
                </div>
            </div>
            @if ($contact->map && $contact->map != '-')
                <div class="border-primary border-4 rounded-lg mt-4">
                    <iframe src="{{ $contact->map }}" width="600" height="450" style="border:0;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
