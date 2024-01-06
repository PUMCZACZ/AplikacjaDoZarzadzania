<x-app-layout>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css"/>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        <a href="{{ route('orders.create') }}">{{ __('Dodaj Zamówienie') }}</a>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table id="datatable" class="display">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3">{{ __('Klient') }}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('Nazwa Zamówienia') }}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('Typ Zamówienia') }}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('Ilość') }}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('J.M') }}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('Cena') }}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('Termin Realizacji') }}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('Akcje') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr class="text-base bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $order->client->fullName() }}</td>
                                    <td class="px-6 py-4">{{ $order->order_name }}</td>
                                    <td class="px-6 py-4">{{ $order->order_type->translate() }}</td>
                                    <td class="px-6 py-4">{{ $order->quantity }}</td>
                                    <td class="px-6 py-4">{{ $order->unit?->name }}</td>
                                    <td class="px-6 py-4">{{ $order->price }}  zł</td>
                                    <td class="px-6 py-4">{{ $order->deadlineDate() }}</td>
                                    <td>
                                        <div class="flex flex-row space-x-1.5">
                                            <a href="{{ route('orders.show', $order) }}">{{ __('Zobacz') }}</a>
                                            <a href="{{ route('orders.edit', $order) }}">{{  __('Edytuj') }}</a>
                                            <form action="{{ route('orders.destroy', $order) }}" method="POST">
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
