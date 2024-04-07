@extends('layouts.master')

@section('title', 'Tworzenie zamówienia')

@push('page-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="jquery.datetimepicker.css"/>
@endpush

@section('content')
    <div class="container">
        <div class="card shadow-lg p-3 mb-3 bg-body rounded">
            <h1 class="mb-4">{{ __('Tworzenie klienta') }}</h1>
            <div>
                <form action="{{ route('clients.store') }}" method="POST">
                @csrf
                    <div class="mb-3">
                        <label class="form-label" for="first_name">Imię</label>
                        <input class="form-control" value="{{ old('first_name') }}" name="first_name" />
                        @error('first_name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="last_name">Nazwisko</label>
                        <input class="form-control" value="{{ old('last_name') }}" name="last_name" />
                        @error('last_name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="last_name">Miejsowość</label>
                        <input class="form-control" value="{{ old('city') }}" name="city" />
                        @error('city')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="last_name">Ulica</label>
                        <input class="form-control" value="{{ old('street') }}" name="street" />
                        @error('street')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-1" for="last_name">Kod Pocztowy</label>
                        <input class="form-control" value="{{ old('post_code') }}" name="post_code" />
                        @error('post_code')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="last_name">Numer Telefonu</label>
                        <input class="form-control" value="{{ old('phone_number') }}" name="phone_number" />
                        @error('phone_number')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary px-4 py-2">Zapisz</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
