@extends('layouts.master')

@section('title', 'Podgląd zamówienia')

@push('page-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
@endpush

@section('content')

{{-- Karta zamówienia --}}
<div class="container">
    <div class="card shadow-lg p-3 mb-3 bg-body rounded">
        <div class="card-header shadow p-3 mb-3 bg-body rounded">
            <h4>
                <i class="bi bi-bar-chart-steps text-danger" style="font-size: 2rem;"> </i>
                Zamówienie:
            </h4>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="client_id">
                <i class="bi bi-person"></i><span>Klient</span>
            </label>
            <input class="form-control" value="{{ $order->client->fullName() }}" disabled/>
            <button class="input-group-text">
                <a href="{{ route('clients.show', $order->client) }}">
                    <i class="bi bi-info-circle-fill"></i>
                </a>
            </button>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="order_name">
                <i class="bi bi-card-text"></i> <span>Nazwa Zamówienia</span>
            </label>
            <input class="form-control" value="{{ $order->order_name}}" disabled/>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="order_type">
                Typ Zamówienia
            </label>
            <input class="form-control" value="{{ $order->order_type->translate() }}" disabled/>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="quantity">
                Ilość
            </label>
            <input type="text" class="form-control" value="{{ $order->quantity . ' kg'}}" disabled/>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="price">
                Cena
            </label>
            <input type="text" class="form-control" value="{{ $order->price . ' zl' }}" disabled/>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="last_name">
                Szacowany termin realizacji
            </label>
            <input type="date" class="form-control"
                   value="{{ \Carbon\Carbon::parse($order->deadline)->format('Y-m-d') }}" disabled/>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="delivery_method">
                Sposób dostawy
            </label>
            <input class="form-control" name="delivery_method" value="{{ $order->delivery_metohd?->translate() }}"
                   disabled>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="last_name">
                Termin realizcji zamówienia
            </label>
            <input class="form-control" value="{{ $order->realised_at ?? 'Nie zrealizowano' }}" disabled/>
        </div>
    </div>

    {{-- Płatności --}}
    <div class="card card shadow-lg p-3 mb-3 bg-body rounded">
        <div class="card-header shadow p-3 mb-2 bg-body rounded">
            <h4>
                <i class="bi bi-wallet-fill text-danger" style="font-size: 2rem;"> </i>
                Płatności do zamówienia:
            </h4>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>L.p</td>
                    <td>Kwota</td>
                    <td>Termin wpłaty</td>
                </tr>
                </thead>
                <tbody>
                @foreach($order->payments as $payment)
                    <tr>
                        <td>{{ $loop->index }}</td>
                        <td>{{ $payment->amount }}zł</td>
                        <td>{{ $payment->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mb-3 text-end">
            <p class="card-text">Suma płatności: <span>100 zł</span></p>
            <p class="card-text">Kwota zamówienia: <span>{{ $order->price }} zł</span></p>
            <p class="card-text {{-- Jeśli pozostało do zapłaty >0 text-danger jeśli = 0 text-success  --}}">Pozostało
                do zapłaty: <span>1000 zł</span></p>
        </div>
        <div class="mb-3 text-end">
            <a class="btn btn-warning" href="{{ route('payment.create', $order) }}" role="button">Dodaj płatność
                częściową</a>
            <a class="btn btn-success" href="{{ route('payment.create', $order) }}" role="button">Dodaj płatność
                całkowitą</a>
        </div>
    </div>
</div>

    {{-- Wydania --}}

<div class="card card shadow-lg p-3 mb-3 bg-body rounded">
    <div class="card-header shadow p-3 mb-2 bg-body rounded">
        <h4>
            <i class="bi bi-box-arrow-right text-danger" style="font-size: 2rem;"> </i>
            Wydania do zamówienia:
        </h4>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <td>L.p</td>
                <td>Ilość</td>
                <td>Termin wydania</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1.</td>
                <td>100 kg</td>
                <td>12.11.2019</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="mb-3 text-end">
        <p class="card-text">Suma wydań: <span>100 kg</span></p>
        <p class="card-text">Ilość z zamówienia: <span>{{ $order->price }} zł</span></p>
        <p class="card-text {{-- Jeśli pozostało do zapłaty >0 text-danger jeśli = 0 text-success  --}}">Pozostało do
            wydania: <span>1000 zł</span></p>
    </div>
    <div class="mb-3 text-end">
        <a class="btn btn-warning" href="{{ route('payment.create', $order) }}" role="button">Dodaj wydanie
            częściowe</a>
        <a class="btn btn-success" href="{{ route('payment.create', $order) }}" role="button">Dodaj wydanie
            całkowite</a>
    </div>
</div>
@endsection


