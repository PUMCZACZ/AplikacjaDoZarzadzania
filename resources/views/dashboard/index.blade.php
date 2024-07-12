@extends('layouts.master')

@section('title', 'Dashboard')

@push('page-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
@endpush

@section('content')
    <Dashboard></Dashboard>
@endsection

@push('page-scripts')
@endpush
