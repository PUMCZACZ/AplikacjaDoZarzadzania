@extends('layouts.master')

@section('title', 'Dashboard')

@push('page-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
@endpush

@section('content')
    <div class="container">
        <div class="row mt-4">

            <div class="col-sm-12">

                <div class="card shadow-lg p-3 mb-3 bg-body rounded">
                    <div class="card-header shadow p-3 mb-2 bg-body rounded">
                        <h1><i class="bi bi-bar-chart-steps text-danger" style="font-size: 2rem;"> </i>Dane zapotrzebowania</h1>
                    </div>
                    <div class="row mt-4 mb-4 px-2">
                        <div class="col-sm-4">
                            <div class="card mb-2">
                                <div class="card-header shadow p-3 mb-2 bg-body rounded">
                                    Aktualny miesiąc
                                </div>
                                <div class="card-body mb-2">
                                    0.0 ton
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card mb-2">
                                <div class="card-header shadow p-3 mb-2 bg-body rounded">
                                    Następny miesiąc
                                </div>
                                <div class="card-body mb-2">
                                    {{ $nextMonthDemand }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card mb-2">
                                <div class="card-header shadow p-3 mb-2 bg-body rounded">
                                    Za 2 miesiące
                                </div>
                                <div class="card-body mb-2">
                                    {{ $nextTwoMonthDemand }}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <div class="card mt-2 shadow-lg p-3 mb-4 bg-body rounded">
            <div class="card-header shadow p-3 mb-4 bg-body rounded">
                <h1><i class="bi bi-truck pd-1 text-danger" style="font-size: 2rem;"> </i>Tabela wywozów / odbiorów</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="mb-2">Zakres dni</p>
                        <select id="day-filter" class="form-select shadow mb-3">
                            <option value="1">{{ __('Dzisiaj') }}</option>
                            <option value="3">{{ __('3 dni') }}</option>
                            <option value="7">{{ __('7 dni') }}</option>
                            <option value="all">{{ __('Wszystkie') }}</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-2">Kateogria</p>
                        <select id="delivery-type" class="form-select shadow mb-5">
                            <option value="all">Wszystkie</option>
                            @foreach(\App\Domains\Order\Enums\OrderDeliveryMethodEnum::cases() as $orderDeliveryMethod)
                                <option value="{{ $orderDeliveryMethod->value }}">
                                    {{ $orderDeliveryMethod->translate() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row p-2">

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col" class="">{{ __('Id') }}</th>
                                <th scope="col" class="">{{ __('Klient') }}</th>
                                <th scope="col" class="">{{ __('Nazwa Zamówienia') }}</th>
                                <th scope="col" class="">{{ __('Typ Zamówienia') }}</th>
                                <th scope="col" class="">{{ __('Ilość') }}</th>
                                <th scope="col" class="">{{ __('J.M') }}</th>
                                <th scope="col" class="">{{ __('Cena') }}</th>
                                <th scope="col" class="">{{ __('Termin Realizacji') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2 shadow-lg p-3 mb-5 bg-body rounded">
            <div class="price card-header shadow p-3 mb-4 bg-body rounded">
                <i class="bi bi-cash-coin pd-1 text-danger" style="font-size: 2rem;"> </i>Suma ze wszystkich zamówień
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-6 text-center">
                        <p class="text-center inline" style="font-size:4rem;" id="sumValue"></p> <p class="inline" style="font-size:2rem;">zł</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-scripts')
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        function getDay() {
            return $('#day-filter').val();
        }

        function getDeliveryType() {
            return $("#delivery-type").val();
        }

        function reloadData() {
            table.ajax.reload();
        }

        $('#day-filter').change(() => {
            reloadData();
        });

        $('#delivery-type').change(() => {
            reloadData();
        });

        let table = new DataTable('#datatable',{
            responsive: true,
            ajax: {
                type: 'GET',
                url: '{{ route('dashboard.get.orders') }}',
                data: function(data) {
                    data.day = getDay();
                    data.delivery_type = getDeliveryType();
                },
                dataSrc: function (response) {
                    $('#sumValue').html(response.meta.sumPrice);

                    return response.data;
                }
            },
            columns: [
                {'data': 'id'},
                {'data': 'client'},
                {'data': 'order_name'},
                {'data': 'order_type'},
                {'data': 'quantity'},
                {'data': 'unit'},
                {'data': 'price'},
                {'data': 'deadline'},
            ],
        });

        table.on('click', 'tr', function () {
            let order = table.row(this).data();

            window.location.href = '{{ route('orders.show', [':order']) }}'.replace(':order', order.id);
        });
    </script>
@endpush
