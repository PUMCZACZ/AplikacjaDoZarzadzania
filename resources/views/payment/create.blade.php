<x-app-layout>
    <div class="flex flex-col justify-items-center">
        <form action="{{ route('payment.store', $order) }}" method="POST">
            @csrf
            <div class="text-white">
                <p>Zapłacono: {{ $paymentInfo['payed'] }}</p>
                <p>Zostało do uregulowania: {{ $paymentInfo['toPay'] }}</p>
                <p>Wartość zamówienia: {{ $order->price }}</p>
            </div>
            <div class="w-1/3">
                <label class="flex flex-col">
                    <span class="text-white">Kwota</span>
                    <input name="amount" value="{{ old('amount') }}" />
                </label>
            </div>
            <div>
                <button class="text-white">Dodaj</button>
            </div>
        </form>
    </div>
</x-app-layout>
