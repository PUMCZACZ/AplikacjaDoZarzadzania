<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="jquery.datetimepicker.css"/>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edycja Zamówienia') . $order->order_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('orders.update', $order) }}" method="POST">
                        @csrf
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="client_id">Klient</label>
                            <select class="select2" name="client_id">
                                @foreach($clients as $client)
                                    <option value="{{ old('client_id', $client->id) }}"
                                        @selected($client->id === $order->client->id)>
                                        {{ $client->fullName() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="order_name">Nazwa Zamówienia</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ old('order_name', $order->order_name) }}" name="order_name" />
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="order_type">Typ Zamówienia</label>
                            <select class="border-gray-200 rounded-md text-black" name="order_type">
                                @foreach(\App\Domains\Order\Enums\OrderTypeEnum::cases() as $orderType)
                                    <option value="{{ $orderType->value }}"
                                        @selected($orderType->value == $order->order_type->value)>
                                        {{ $orderType->translate() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-row mb-4">
                            <label class="mb-1" for="quantity">Ilość</label>
                            <input type="number" step="0.01" class="border-gray-200 rounded-md text-black" value="{{ old('quantity', $order->quantity) }}" name="quantity" />

                            <label class="mb-1" for="quantity">J.M</label>
                            <select name="unit_id">
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}"
                                        @selected($order->unit?->id == $unit->id)>
                                        {{ $unit->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="price">Cena</label>
                            <input type="number" step="0.01" class="border-gray-200 rounded-md text-black"
                                   value="{{ old('price', $order->price) }}" name="price" />
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="last_name">Szacowany Termin Realizacji</label>
                            <input type="date" class="border-gray-200 rounded-md text-black"
                                   value="{{ \Carbon\Carbon::parse($order->deadline)->format('Y-m-d') ?? \Illuminate\Support\Carbon::now()->toDateString() }}" name="deadline" />
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="order_status">Status Płatności</label>
                            <select name="payment_status">
                                @foreach(\App\Domains\Payment\Enums\PaymentStatusEnum::cases() as $status)
                                    <option value="{{ $status->value }}"
                                            @if($paymentStatus->status === $status->value) selected @endif>
                                        {{ $status->translate() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="delivery_method">Sposób Dostawy</label>
                            <select name="delivery_method">
                                @foreach(\App\Domains\Order\Enums\OrderDeliveryMethodEnum::cases() as $deliveryMethod)
                                    <option value="{{ $deliveryMethod->value }}"
                                    @selected($order->delivery_method === $deliveryMethod)>
                                        {{ $deliveryMethod->translate() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="px-4 py-2 rounded-xl bg-blue-500 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-700 ">{{ __('Zapisz') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="jquery.datetimepicker.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'classic',
            });
        });
    </script>
</x-app-layout>


