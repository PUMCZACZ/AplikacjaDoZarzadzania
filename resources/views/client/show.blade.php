@extends('layouts.master')

@section('title', 'Podgląd klienta')

@push('page-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
@endpush

@section('content')
    <div class="container">
        <div class="card shadow-lg p-3 mb-3 bg-body rounded">
            <div class="card-header shadow p-3 mb-3 bg-body rounded">
                <h4>
                    <i class="bi bi-person text-danger" style="font-size: 2rem;"> </i>
                    Dane Klienta:
                </h4>
            </div>
            <div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="client_id">
                        <span>Imię</span>
                    </label>
                    <input class="form-control" value="{{ $client->first_name }}" disabled/>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="client_id">
                       <span>Nazwisko</span>
                    </label>
                    <input class="form-control" value="{{ $client->last_name }}" disabled/>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="client_id">
                        <span>Miejscowość</span>
                    </label>
                    <input class="form-control" value="{{ $client->city }}" disabled/>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="client_id">
                        <span>Kod pocztowy</span>
                    </label>
                    <input class="form-control" value="{{ $client->post_code }}" disabled/>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="client_id">
                        <span>Numer telefonu</span>
                    </label>
                    <input class="form-control" value="{{ $client->phone_number }}" disabled/>
                </div>
            </div>
        </div>
        <div class="card card shadow-lg p-3 mb-3 bg-body rounded">
            <div class="card-header shadow p-3 mb-2 bg-body rounded">
                <h4>
                    <i class="bi bi-wallet-fill text-danger" style="font-size: 2rem;"> </i>
                    Zamówienia klienta:
                </h4>
            </div>
            <div class="table-responsive mt-2">
                <table id="datatable" class="table table-striped">
                    <thead>
                    <tr>
                        <td>{{ __('Nazwa zamówienia') }}</td>
                        <td>{{ __('Typ zamówienia') }}</td>
                        <td>{{ __('Ilość') }}</td>
                        <td>{{ __('Cena') }}</td>
                        <td>{{ __('Szacowany termin realizacji') }}</td>
                        <td>{{ __('Status') }}</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($client->orders as $order)
                        <tr class="redirect" ondblclick="redirectToOrder({{ $order }})">
                            <td class="px-6 py-4">{{ $order->order_name }}</td>
                            <td class="px-6 py-4">{{ $order->order_type }}</td>
                            <td class="px-6 py-4">{{ $order->quantity }}</td>
                            <td class="px-6 py-4">{{ $order->price }}</td>
                            <td class="px-6 py-4">{{ $order->deadlineDate() }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('page-scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        new DataTable('#datatable');

        function redirectToOrder(order) {
            window.location.href = '{{ route('orders.show', [':order']) }}'.replace(':order', order.id);
        }
    </script>
@endpush

