@section('title', 'Tambah Data Materi')

<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.card-default class="static">
                <a href="{{ route('admin.material.index') }}">
                    <x-button.info-button>
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </x-button.info-button>
                </a>

                <x-form action="{{ route('admin.material.store') }}" class="md:grid md:grid-cols-2 gap-4"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mt-4">
                        <x-input.input-label for="cover" :value="__('Cover')" />
                        <x-input.input-file id="cover" class="mt-1 w-full" type="file" name="cover"
                            :value="old('cover')" required autofocus autocomplete="cover" />
                        <x-input.input-error :messages="$errors->get('cover')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input.input-label for="file" :value="__('File Materi (PDF)')" />
                        <x-input.input-file id="file" class="mt-1 w-full" type="file" name="file"
                            :value="old('file')" required autofocus autocomplete="file" />
                        <x-input.input-error :messages="$errors->get('file')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input.input-label for="title" :value="__('Judul Materi')" />
                        <x-input.text-input id="title" class="mt-1 w-full" type="text" name="title"
                            :value="old('title')" required autofocus autocomplete="title" />
                        <x-input.input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>


                    <div class="mt-4">
                        <x-input.input-label for="type" :value="__('Tipe')" />
                        <x-input.select-input id="type" class="mt-1 w-full" type="text" name="type" required
                            autofocus autocomplete="type">
                            <option value="" disabled selected>Pilih Tipe</option>
                            <option value="0" {{ old('type') == '0' ? ' selected' : ' ' }}>PPT
                            </option>
                            <option value="1" {{ old('type') == '1' ? ' selected' : ' ' }}>Artikel
                            </option>
                        </x-input.select-input>
                    </div>

                    <div class="mt-4">
                        <x-input.input-label for="excerpt" :value="__('Ringkasan')" />
                        <x-input.text-input id="excerpt" class="mt-1 w-full" type="text" name="excerpt"
                            :value="old('excerpt')" required autofocus autocomplete="excerpt" />
                        <x-input.input-error :messages="$errors->get('excerpt')" class="mt-2" />
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
