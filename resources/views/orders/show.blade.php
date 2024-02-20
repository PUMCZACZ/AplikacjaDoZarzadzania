<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Podgląd Zamówienia') . ': ' . $order->order_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="client_id">Klient</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ $order->client->fullName() }}" disabled/>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="order_name">Nazwa Zamówienia</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ $order->order_name}}" disabled/>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="order_type">Typ Zamówienia</label>
                            <input class="border-gray-200 rounded-md text-black" value="{{ $order->order_type->translate() }}" disabled/>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="quantity">Ilość</label>
                            <input type="number" step="0.01" class="border-gray-200 rounded-md text-black" value="{{ $order->quantity }}" disabled/>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="price">Cena</label>
                            <input type="number" step="0.01" class="border-gray-200 rounded-md text-black" value="{{ $order->price }}" disabled/>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-1" for="last_name">Szacowany Termin Realizacji</label>
                            <input type="date" class="border-gray-200 rounded-md text-black" value="{{ \Carbon\Carbon::parse($order->deadline)->format('Y-m-d') }}" disabled/>
                        </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-1" for="delivery_method">Sposób Dostawy</label>
                        <input name="delivery_method" value="{{ $order->delivery_metohd?->translate() }}" disabled>
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-1" for="last_name">Termin Realizacji Zamówienia</label>
                        <input class="border-gray-200 rounded-md text-black" value="{{ $order->realised_at ?? 'Nie zrealizowano' }}" disabled/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-lg font-bold">Dane Klienta</h1>
                <div></div>
            </div>
        </div>
    </div>
</x-app-layout>


