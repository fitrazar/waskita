@section('title', 'Tambah Data Quiz')

<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.card-default class="static">
                <a href="{{ route('admin.quiz.index') }}">
                    <x-button.info-button>
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </x-button.info-button>
                </a>

                <x-form action="{{ route('admin.quiz.store') }}" class="md:grid md:grid-cols-2 gap-4"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mt-4">
                        <x-input.input-label for="title" :value="__('Judul Quiz')" />
                        <x-input.text-input id="title" class="mt-1 w-full" type="text" name="title"
                            :value="old('title')" required autofocus autocomplete="title" />
                        <x-input.input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input.input-label for="description" :value="__('Deksripsi Quiz')" />
                        <x-input.text-input id="description" class="mt-1 w-full" type="text" name="description"
                            :value="old('description')" required autofocus autocomplete="description" />
                        <x-input.input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input.input-label for="form" :value="__('Link Quiz')" />
                        <x-input.text-input id="form" class="mt-1 w-full" type="text" name="form"
                            :value="old('form')" required autofocus autocomplete="form" />
                        <x-input.input-error :messages="$errors->get('form')" class="mt-2" />
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
