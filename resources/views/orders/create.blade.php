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
                    <div class="mb-3">
                        <label class="form-label" for="client_id">Klient</label>
                        <select class="select2 form-select" name="client_id">
                            @foreach($clients as $client)
                                <option value="{{ old('client_id', $client->id) }}">{{ $client->fullName() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-form.input name="order_name" label="Nazwa Zamówienia" id="order-name"
                                  value="{{ old('order_name') }}" />
                    <x-form.select name="order_type" id="order-type" label="Typ Zamówienia">
                        @foreach(\App\Domains\Order\Enums\OrderTypeEnum::cases() as $orderType)
                            <option value="{{ $orderType->value }}" @selected(old('order_type' === $orderType->value))>
                                {{ $orderType->translate() }}
                            </option>
                        @endforeach
                    </x-form.select>
                    <x-form.input type="number" name="order_name" label="Nazwa Zamówienia" id="order-name"
                                  value="{{ old('order_name') }}" />
                    <div class="mb-3">
                        <label class="form-label" for="package_quantity">Ilość (opakowania)</label>
                        <input type="number" step="1" class="form-control" value="{{ old('package_quantity') }}"
                               name="package_quantity" id="package-quantity"/>
                    </div>
                    <div class="d-flex flex-column lg:flex-row gap-3 mb-3">
                        <div>
                            <label class="form-label" for="quantity">Ilość</label>
                            <input type="number" step="0.01" class="form-control" value="{{ old('quantity') }}"
                                   name="quantity" id="quantity"/>
                        </div>
                        <div>
                            <label class="form-label" for="quantity">J.M</label>
                            <select name="unit_id" class="form-select">
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="price">Cena</label>
                        <input type="number" step="0.01" class="form-control" value="{{ old('price') }}" name="price"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="order_status">Status Płatności</label>
                        <select class="form-select" name="payment_status">
                            @foreach(\App\Domains\Payment\Enums\PaymentStatusEnum::cases() as $paymentStatus)
                                <option value="{{ $paymentStatus->value }}">
                                    {{ $paymentStatus->translate() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="delivery_method">Sposób Dostawy</label>
                        <select class="form-select" name="delivery_method">
                            @foreach(\App\Domains\Order\Enums\OrderDeliveryMethodEnum::cases() as $deliverMethod)
                                <option value="{{ $deliverMethod->value }}">
                                    {{ $deliverMethod->translate() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="last_name">Szacowany Termin Realizacji</label>
                        <input type="date" class="form-control"
                               value="{{ old('deadline', \Illuminate\Support\Carbon::now()->toDateString()) }}"
                               name="deadline"/>
                    </div>
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

            function calculateToKilos() {
                let packageQuantityValue = parseInt(packageQuantity.val());
                const bagWeight = 15;

                if(packageQuantity === 0) {
                    return;
                }

                return packageQuantityValue * bagWeight;
            }

            packageQuantity.on('change', function () {
                let orderType = $('#order-type').val()

                if(orderType === '{{ \App\Domains\Order\Enums\OrderTypeEnum::BAG->value }}') {
                    $('#quantity').val(calculateToKilos());
                }
            });
        });
    </script>
@endpush
