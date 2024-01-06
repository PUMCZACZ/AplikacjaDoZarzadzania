<x-app-layout>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('clients.update', $client) }}" method="POST">
                        @csrf
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="first_name">Imię</label>
                            <input class="border-gray-200 rounded-md text-black " value="{{ old('first_name', $client->first_name) }}" name="first_name" />
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="last_name">Nazwisko</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ old('last_name', $client->last_name) }}" name="last_name" />
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="last_name">Miejsowość</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ old('city', $client->city) }}" name="city" />
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="last_name">Kod Pocztowy</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ old('post_code', $client->post_code) }}" name="post_code" />
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="last_name">Numer Telefonu</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ old('phone_number', $client->phone_number) }}" name="phone_number" />
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
