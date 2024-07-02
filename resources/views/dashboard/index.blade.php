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
                        Aktualny miesiąc
                    </div>
                    <div class="row mt-4 mb-4 px-2">
                        <div class="col-sm-4">
                            <div class="card mb-2">
                                <div class="card-header shadow p-3 mb-2 bg-body rounded">
                                    Aktualny miesiąc
                                </div>
                                <div class="card-body mb-2">
                                    {{ $materialDemand }}
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
                    <export-table
                        :delivery-methods="{{ json_encode(\App\Domains\Order\Enums\OrderDeliveryMethodEnum::toArray()) }}">
                    </export-table>
            </div>
        </div>
        <div class="card mt-2 shadow-lg p-3 mb-5 bg-body rounded">
            <div class="price card-header shadow p-3 mb-4 bg-body rounded">
                <i class="bi bi-box-seam pd-1 text-danger" style="font-size: 2rem;"> </i>Suma ze wszystkich zamówień
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-6 text-center">
                        <p class="text-center inline" style="font-size:4rem;" id="sumKg"></p>
                        <p class="inline" style="font-size:2rem;">kg</p>
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
                        <p class="text-center inline" style="font-size:4rem;" id="sumValue"></p>
                        <p class="inline" style="font-size:2rem;">zł</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-scripts')
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        let dateFrom = $('#date_from');
        let dateTo = $('#date_to');
        let materialDemand = $('#material-demand');
        let realisedStatus = $('#realised-status');

        function getDateFrom() {
            return dateFrom.val();
        }
        function getDateTo() {
            return dateTo.val();
        }

        function getDeliveryType() {
            return $("#delivery-type").val();
        }

        function getRealisationStatus() {
            return realisedStatus.val();
        }

        function reloadData() {
            table.ajax.reload();
        }

        realisedStatus.on('change', function () {
            reloadData();
        })

        dateTo.change(() => {
            reloadData();
        });

        dateFrom.change(() => {
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
                    data.date_from = getDateFrom();
                    data.date_to = getDateTo();
                    data.delivery_type = getDeliveryType();
                    data.realisation_status = getRealisationStatus();
                },
                dataSrc: function (response) {
                    $('#sumValue').html(response.meta.sumPrice);
                    $('#sumKg').html(response.meta.sumKg);
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
