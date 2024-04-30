@extends('layouts.master')

@section('title', 'Podgląd zamówienia')

@push('page-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
@endpush

@section('content')

    <div class="container">
        <form action="{{ route('release.store', $order) }}" method="POST">
            @csrf
            <div class="card card shadow-lg p-3 mb-3 bg-body rounded">
                <div class="card-header shadow p-3 mb-4 bg-body rounded">
                    <h4>
                        <i class="bi bi-wallet-fill text-danger" style="font-size: 2rem;"> </i>
                        Wydanie do zamówienia:
                    </h4>
                </div>

                <div class="input-group mb-3">
                    <label class="input-group-text">Ilość wydanego towaru</label>
                    <input class="form-control" name="quantity" value="{{ old('quantity') }}" />
                </div>
                <div class="d-flex flex-column text-end">
                    <p>Wydano: {{ $releaseInfo['released'] }} kg</p>
                    <p>Zostało do wydania: {{ $releaseInfo['forRelease'] }} kg</p>
                </div>
                <div class="text-end">
                    <button class="btn btn-success">Dodaj wydanie</button>
                </div>
        </form>
    </div>

@endsection
