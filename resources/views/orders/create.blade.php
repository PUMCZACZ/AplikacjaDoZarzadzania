@extends('layouts.master')

@section('title', 'Tworzenie zamówienia')

@push('page-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="jquery.datetimepicker.css"/>
@endpush

@section('content')
    <div class="container">
        <div class="card shadow-lg p-3 mb-3 bg-body rounded">
            <h1 class="mb-4">{{ __('Tworzenie zamówienia') }}</h1>
            <div>
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <x-form.select class="select2" name="client_id" id="client-id" label="Klient">
                        @foreach($clients as $client)
                            <option value="{{ old('client_id', $client->id) }}">{{ $client->fullName() }}</option>
                        @endforeach
                    </x-form.select>

                    <x-form.input name="order_name" label="Nazwa Zamówienia" id="order-name"
                                  value="{{ old('order_name') }}" />

                    <x-form.select name="order_type" id="order-type" label="Typ Zamówienia">
                        @foreach(\App\Domains\Order\Enums\OrderTypeEnum::cases() as $orderType)
                            <option value="{{ $orderType->value }}" @selected(old('order_type' === $orderType->value))>
                                {{ $orderType->translate() }}
                            </option>
                        @endforeach
                    </x-form.select>

                    <x-form.input type="number" name="package_quantity" label="Ilość (opakowań)" id="package-quantity"
                                  step="1" value="{{ old('package_quantity') }}" />

                    <x-form.input type="number" name="quantity" label="Waga" id="quantity" step="1"
                                  value="{{ old('quantity') }}" />

                    <x-form.input type="number" name="price" label="Cena" id="price" step="0.01"
                                  value="{{ old('price') }}" />

                    <x-form.select name="payment_status" id="payment-status" label="Status Płatności">
                        @foreach(\App\Domains\Payment\Enums\PaymentStatusEnum::cases() as $paymentStatus)
                            <option value="{{ $paymentStatus->value }}">
                                {{ $paymentStatus->translate() }}
                            </option>
                        @endforeach
                    </x-form.select>

                    <x-form.input type="number" id="payment-amount" name="payment_amount" value="{{ old('payment_amount') }}"
                                  label="Kwota zapłaty" step="0.01"/>

                    <x-form.select name="delivery_method" id="delivery-method" label="Sposób dostawy">
                        @foreach(\App\Domains\Order\Enums\OrderDeliveryMethodEnum::cases() as $deliverMethod)
                            <option value="{{ $deliverMethod->value }}">
                                {{ $deliverMethod->translate() }}
                            </option>
                        @endforeach
                    </x-form.select>

                    <x-form.input type="date" name="deadline" id="deadline" label="Szacowany Termin Realizacji"
                                  value="{{ old('deadline', \Illuminate\Support\Carbon::now()->toDateString()) }}" />

                    <div class="mt-5">
                        <button class="btn btn-primary px-4 py-2" type="submit">Zapisz</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('page-scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="jquery.datetimepicker.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'classic',
            });

            let packageQuantity = $('#package-quantity');
            let paymentStatus = $('#payment-status');
            let paymentAmountInput = $('#payment-amount');

            function calculateToKilos(orderTypeWeight) {
                let packageQuantityValue = parseInt(packageQuantity.val());

                if(packageQuantity === 0) {
                    return;
                }

                return packageQuantityValue * orderTypeWeight;
            }

            function changePaymentAmountInputVisibility() {
                if (paymentStatus.val() === '{{ \App\Domains\Payment\Enums\PaymentStatusEnum::ISSUED }}') {
                    paymentAmountInput.closest('div').removeClass('d-none');
                } else {
                    paymentAmountInput.closest('div').addClass('d-none');
                }
            }

            packageQuantity.on('change', function () {
                let orderType = $('#order-type').val()
                const bagWeight = 15;
                const palleteWeight = 990;

                if(orderType === '{{ \App\Domains\Order\Enums\OrderTypeEnum::BAG->value }}') {
                    $('#quantity').val(calculateToKilos(bagWeight));
                }

                if(orderType === '{{ \App\Domains\Order\Enums\OrderTypeEnum::PALLET->value }}') {
                    $('#quantity').val(calculateToKilos(palleteWeight));
                }
            });

            paymentStatus.on('change', function () {
                changePaymentAmountInputVisibility();
            });

        });
    </script>
@endpush
