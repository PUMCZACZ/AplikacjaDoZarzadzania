<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Klient utwórz') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('clients.store') }}" method="POST">
                        @csrf
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="first_name">Imię</label>
                            <input class="border-gray-200 rounded-md text-black " value="{{ old('first_name') }}" name="first_name" />
                            @error('first_name')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="last_name">Nazwisko</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ old('last_name') }}" name="last_name" />
                            @error('last_name')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="last_name">Miejsowość</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ old('city') }}" name="city" />
                            @error('city')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="last_name">Ulica</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ old('street') }}" name="street" />
                            @error('street')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="last_name">Kod Pocztowy</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ old('city') }}" name="post_code" />
                            @error('post_code')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="last_name">Numer Telefonu</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ old('city') }}" name="phone_number" />
                            @error('phone_number')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="px-4 py-2 rounded-xl bg-blue-500 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-700 ">{{ __('Zapisz') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
