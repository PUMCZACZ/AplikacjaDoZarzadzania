@extends('layouts.master')

@section('title', 'Edycja klienta')

@push('page-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="jquery.datetimepicker.css"/>
@endpush

@section('content')
    <div class="container">
        <div class="card shadow-lg p-3 mb-3 bg-body rounded">
            <h1 class="mb-4">{{ __('Tworzenie klienta') }}</h1>
            <form action="{{ route('clients.update', $client) }}" method="POST">
                @csrf
                <x-form.input name="first_name" id="first-name" value="{{ old('first_name', $client->first_name) }}"
                              label="Imię"/>

                <x-form.input name="last_name" id="last-name" value="{{ old('last_name', $client->last_name) }}"
                              label="Nazwisko"/>

                <x-form.input name="city" id="city" value="{{ old('city', $client->city) }}" label="Miejsowość"/>

                <x-form.input name="street" id="street" value="{{ old('street', $client->street) }}"
                              label="Ulica"/>

                <x-form.input name="post_code" id="post-code" value="{{ old('post_code', $client->post_code) }}"
                              label="Kod pocztowy"/>

                <x-form.input name="phone_number" id="phone-number"
                              value="{{ old('phone_number', $client->phone_number) }}" label="Numer telefonu"/>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary px-4 py-2">{{ __('Zapisz') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('page-scripts')

@endpush
