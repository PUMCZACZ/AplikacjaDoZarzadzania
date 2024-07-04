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
            <view-sum-weight></view-sum-weight>
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
@endpush
