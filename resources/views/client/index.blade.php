<x-app-layout>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css"/>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <a class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-xl " href="{{ route('clients.create') }}">{{ __('Dodaj Klienta') }}</a>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table id="datatable" class="display">
                            <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">{{ __('Imie') }}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('Nazwisko') }}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('Miejsowość') }}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('Nr tel') }}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('Akcje') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                <tr class="text-base bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $client->first_name }}</td>
                                    <td class="px-6 py-4">{{ $client->last_name }}</td>
                                    <td class="px-6 py-4">{{ $client->city }}</td>
                                    <td class="px-6 py-4">{{ $client->phone_number }}</td>
                                    <td>
                                        <div class="flex flex-row space-x-1.5">
                                            <a href="{{ route('clients.show', $client) }}">{{ __('Zobacz') }}</a>
                                            <a href="{{ route('clients.edit', $client) }}">{{  __('Edytuj') }}</a>
                                            <form action="{{ route('clients.destroy', $client) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button>{{ __('Usuń') }}</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.tailwindcss.com"></script>
    <script>
        new DataTable('#datatable');
    </script>
</x-app-layout>
