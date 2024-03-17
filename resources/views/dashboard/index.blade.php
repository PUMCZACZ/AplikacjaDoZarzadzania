<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <div class="container">
            <div class="row mt-4">
               
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                Zapotrzebowanie:
                            </div>
                                <div class="row mt-4 mb-4 px-2">
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-header bg-info">
                                            Aktualny miesiąc
                                            </div>
                                            <div class="card-body">
                                            Do zrobienia aktualny ilość zamówień w danym miesącu
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-header bg-info">
                                            Następny miesiąc
                                            </div>
                                            <div class="card-body">
                                            {{ $nextMonthDemand }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-header bg-info">
                                            Za 2 miesiące
                                            </div>
                                            <div class="card-body">
                                            {{ $nextTwoMonthDemand }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                             
                            </div>
                        </div>  
                    </div>
                

                    <div class="card mt-4">
                        <div class="card-header bg-info">
                            Tabela wywozów / odbiorów
                        </div>
                        <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>Dzień wywozów</p>
                                <select id="day-filter" class="text-black">
                                    <option value="1">{{ __('Dzisiaj') }}</option>
                                    <option value="3">{{ __('3 dni') }}</option>
                                    <option value="7">{{ __('7 dni') }}</option>
                                    <option value="all">{{ __('Wszystkie') }}</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <p>Kateogria</p>
                                <select id="delivery-type" class="text-black">
                                <option value="all">Wszystkie</option>
                                @foreach(\App\Domains\Order\Enums\OrderDeliveryMethodEnum::cases() as $orderDeliveryMethod)
                                <option value="{{ $orderDeliveryMethod->value }}">
                                    {{ $orderDeliveryMethod->translate() }}
                                </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table">  
                                <table id="datatable" class="table table-striped">
                                    <thead>
                                        <tr class="redirect">
                                            <th scope="col" class="px-6 py-3">{{ __('Id') }}</th>
                                            <th scope="col" class="px-6 py-3">{{ __('Klient') }}</th>
                                            <th scope="col" class="px-6 py-3">{{ __('Nazwa Zamówienia') }}</th>
                                            <th scope="col" class="px-6 py-3">{{ __('Typ Zamówienia') }}</th>
                                            <th scope="col" class="px-6 py-3">{{ __('Ilość') }}</th>
                                            <th scope="col" class="px-6 py-3">{{ __('J.M') }}</th>
                                            <th scope="col" class="px-6 py-3">{{ __('Cena') }}</th>
                                            <th scope="col" class="px-6 py-3">{{ __('Termin Realizacji') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <div class="price">Suma ze wszystkich zamówień: <span id="sumValue"></span> zł</div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

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
</x-app-layout>
