<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="first_name">Imię</label>
                            <input class="border-gray-200 rounded-md text-black " value="{{  $client->first_name }}" name="first_name" disabled/>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="last_name">Nazwisko</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ $client->last_name }}" name="last_name" disabled/>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="last_name">Miejsowość</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ $client->city }}" name="city" disabled/>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="last_name">Kod Pocztowy</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ $client->post_code }}" name="post_code" disabled/>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="last_name">Numer Telefonu</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ $client->phone_number }}" name="phone_number" disabled/>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-16">
        <table id="datatable" class="display">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3">{{ __('Nazwa Zamówienia') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Typ Zamówienia') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Ilość') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('J.M') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Cena') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Termin Realizacji') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($client->orders as $order)
                    <tr class="redirect" onclick="redirectToOrder({{ $order }})">
                        <td class="px-6 py-4">{{ $order->order_name }}</td>
                        <td class="px-6 py-4">{{ $order->order_type }}</td>
                        <td class="px-6 py-4">{{ $order->quantity }}</td>
                        <td class="px-6 py-4">{{ $order->unit?->name }}</td>
                        <td class="px-6 py-4">{{ $order->price }}</td>
                        <td class="px-6 py-4">{{ $order->deadlineDate() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        new DataTable('#datatable');

        function redirectToOrder(order) {
            window.location.href = '{{ route('orders.show', [':order']) }}'.replace(':order', order.id);
        }
    </script>
</x-app-layout>

