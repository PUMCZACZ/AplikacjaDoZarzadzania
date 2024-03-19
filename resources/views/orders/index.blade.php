@extends('layouts.master')

@section('title', 'Klienci')

@push('page-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
@endpush

@section('content')
    <div class="container">
        <div>
            <a class="btn btn-primary mb-4" href="{{ route('orders.create') }}">{{ __('Dodaj Zamówienie') }}</a>
        </div>
        <div class="table-responsive">
            <table id="datatable" class="table table-striped">
                <thead>
                <tr>
                    <th scope="col" class="px-6 py-3">{{ __('Klient') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Nazwa Zamówienia') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Typ Zamówienia') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Ilość') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('J.M') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Cena') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Termin Realizacji') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Akcje') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="text-base bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <td class="px-6 py-4">{{ $order->client->fullName() }}</td>
                        <td class="px-6 py-4">{{ $order->order_name }}</td>
                        <td class="px-6 py-4">{{ $order->order_type->translate() }}</td>
                        <td class="px-6 py-4">{{ $order->quantity }}</td>
                        <td class="px-6 py-4">{{ $order->unit?->name }}</td>
                        <td class="px-6 py-4">{{ $order->price }} zł</td>
                        <td class="px-6 py-4">{{ $order->deadlineDate() }}</td>
                        <td>
                            <div class="d-flex flex-row gap-2">
                                <a class="btn btn-secondary"
                                   href="{{ route('orders.show', $order) }}">{{ __('Zobacz') }}</a>
                                <a class="btn btn-success"
                                   href="{{ route('orders.edit', $order) }}">{{  __('Edytuj') }}</a>
                                <form action="{{ route('orders.destroy', $order) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">{{ __('Usuń') }}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('page-scripts')
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        new DataTable('#datatable');
    </script>
@endpush
