@section('title', 'Tambah Data Video Edukasi')

<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.card-default class="static">
                <a href="{{ route('admin.video.index') }}">
                    <x-button.info-button>
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </x-button.info-button>
                </a>

                <x-form action="{{ route('admin.video.store') }}" class="md:grid md:grid-cols-2 gap-4"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mt-4">
                        <x-input.input-label for="video" :value="__('Video (MP4, MOV)')" />
                        <x-input.input-file id="video" class="mt-1 w-full" type="file" name="video"
                            :value="old('video')" required autofocus autocomplete="video" />
                        <x-input.input-error :messages="$errors->get('video')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input.input-label for="title" :value="__('Judul Video')" />
                        <x-input.text-input id="title" class="mt-1 w-full" type="text" name="title"
                            :value="old('title')" required autofocus autocomplete="title" />
                        <x-input.input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="col-span-2">
                        <x-button.primary-button type="submit">
                            {{ __('Simpan') }}
                        </x-button.primary-button>
                    </div>

                </x-form>
            </x-card.card-default>
        </div>
    </div>

</x-app-layout>
