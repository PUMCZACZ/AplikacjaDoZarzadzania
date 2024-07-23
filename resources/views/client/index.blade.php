@extends('layouts.master')

@section('title', 'Klienci')

@push('page-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
@endpush

@section('content')
<client-index :clients="{{ $clients }}" />
{{--    <div class="container">--}}
{{--        <div class="mb-4">--}}
{{--            <a class="btn btn-primary " href="{{ route('clients.create') }}">{{ __('Dodaj Klienta') }}</a>--}}
{{--        </div>--}}
{{--        <div class="table-responsive">--}}
{{--            <table id="datatable" class="table table-striped">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th scope="col" class="px-6 py-3">{{ __('Imie') }}</th>--}}
{{--                    <th scope="col" class="px-6 py-3">{{ __('Nazwisko') }}</th>--}}
{{--                    <th scope="col" class="px-6 py-3">{{ __('Ulica') }}</th>--}}
{{--                    <th scope="col" class="px-6 py-3">{{ __('Miejsowość') }}</th>--}}
{{--                    <th scope="col" class="px-6 py-3">{{ __('Nr tel') }}</th>--}}
{{--                    <th scope="col" class="px-6 py-3">{{ __('Akcje') }}</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($clients as $client)--}}
{{--                    <tr>--}}
{{--                        <td class="px-6 py-4">{{ $client->first_name }}</td>--}}
{{--                        <td class="px-6 py-4">{{ $client->last_name }}</td>--}}
{{--                        <td class="px-6 py-4">{{ $client->street }}</td>--}}
{{--                        <td class="px-6 py-4">{{ $client->city }}</td>--}}
{{--                        <td class="px-6 py-4">{{ $client->phone_number }}</td>--}}
{{--                        <td>--}}
{{--                            <div class="d-flex flex-row gap-2">--}}
{{--                                <a class="btn btn-secondary"--}}
{{--                                   href="{{ route('clients.show', $client) }}">{{ __('Zobacz') }}</a>--}}
{{--                                <a class="btn btn-success"--}}
{{--                                   href="{{ route('clients.edit', $client) }}">{{  __('Edytuj') }}</a>--}}
{{--                                <form action="{{ route('clients.destroy', $client) }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    @method('delete')--}}
{{--                                    <button class="btn btn-danger">{{ __('Usuń') }}</button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}

{{--    </div>--}}
@endsection

@push('page-scripts')
{{--    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.0.js"></script>--}}
{{--    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>--}}
{{--    <script>--}}
{{--        new DataTable('#datatable');--}}
{{--    </script>--}}
@endpush
