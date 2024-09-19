@section('title', 'Pengaturan Kontak')

<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.card-default class="static">
                @if (session()->has('success'))
                    <x-alert.success :message="session('success')" />
                @endif

                <x-form action="{{ route('admin.contact.store') }}" class="md:grid md:grid-cols-2 gap-4"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="oldImage" value="{{ $contact?->logo }}">
                    <div class="mt-4">
                        @if ($contact?->logo)
                            <div class="avatar">
                                <div class="w-16 rounded-xl">
                                    <img src="{{ asset('storage/' . $contact?->logo) }}" />
                                </div>
                            </div>
                        @endif
                        <img class="imgPreview h-auto w-16 mx-auto hidden" alt="logo">
                        <x-input.input-label for="logo" :value="__('Logo')" />
                        <x-input.input-file id="logo" class="mt-1 w-full" type="file" name="logo"
                            :value="old('logo', $contact?->logo)" autofocus autocomplete="logo" onchange="previewImage()" />
                        <x-input.input-error :messages="$errors->get('logo')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input.input-label for="name" :value="__('Nama App')" />
                        <x-input.text-input id="name" class="mt-1 w-full" type="text" name="name"
                            :value="old('name', $contact->name ?? '')" required autofocus autocomplete="name" />
                        <x-input.input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input.input-label for="address" :value="__('Alamat')" />
                        <x-input.text-input id="address" class="mt-1 w-full" type="text" name="address"
                            :value="old('address', $contact->address ?? '')" required autofocus autocomplete="address" />
                        <x-input.input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input.input-label for="map" :value="__('Link Google Map')" />
                        <x-input.text-input id="map" class="mt-1 w-full" type="text" name="map"
                            :value="old('map', $contact->map ?? '')" required autofocus autocomplete="map" />
                        <x-input.input-error :messages="$errors->get('map')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input.input-label for="phone" :value="__('No Telpon')" />
                        <x-input.text-input id="phone" class="mt-1 w-full" type="text" name="phone"
                            :value="old('phone', $contact->phone ?? '')" required autofocus autocomplete="phone" />
                        <x-input.input-error :messages="$errors->get('phone')" class="mt-2" />
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
    <x-slot name="script">
        <script>
            function previewImage() {
                const image = document.querySelector('#logo')
                const imgPreview = document.querySelector('.imgPreview')

                imgPreview.style.display = 'block'

                const oFReader = new FileReader()
                oFReader.readAsDataURL(image.files[0])
                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result
                }
            }
        </script>
    </x-slot>
</x-app-layout>
