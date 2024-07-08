@extends('layouts.master')

@section('title', 'Dashboard')

@push('page-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
@endpush

@section('content')


    <div class="container">
        <Dashboard></Dashboard>
        <div class="card mt-2 shadow-lg p-3 mb-5 bg-body rounded">
            <view-sum-weight></view-sum-weight>
        </div>

    </div>
@endsection

@push('page-scripts')
@endpush
