@extends('layouts.master')

@section('title', 'Podgląd zamówienia')

@push('page-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
@endpush

@section('content')

{{-- Karta zamówienia --}}
<div class="container">
        <form action="{{ route('payment.store', $order) }}" method="POST">
            @csrf
            <div class="card card shadow-lg p-3 mb-3 bg-body rounded">
                <div class="card-header shadow p-3 mb-4 bg-body rounded">
                    <h4>
                        <i class="bi bi-wallet-fill text-danger" style="font-size: 2rem;"> </i>
                        Płatności do zamówienia: 
                    </h4>
                </div>
                <div class="text-end">
                    <p>Zapłacono: {{ $paymentInfo['payed'] }}</p>
                    <p>Zostało do uregulowania: {{ $paymentInfo['toPay'] }}</p>
                    <p>Wartość zamówienia: {{ $order->price }}</p>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text">Kwota wpłaty</label>
                    <input class="form-control" name="amount" value="{{ old('amount') }}" />
                </div>
            <div class="text-end">
                <button class="btn btn-success">Dodaj wpłatę</button>
            </div>
        </form>
</div>

@endsection
