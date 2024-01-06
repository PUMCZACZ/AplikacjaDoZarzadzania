<?php

namespace App\Domains\Client\Controllers;

use App\Domains\Client\Models\Client;
use App\Domains\Client\Requests\ClientRequest;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();

        return view('client.index', compact('clients'));
    }

    public function create()
    {
        return view('client.create');
    }

    public function store(ClientRequest $request)
    {
        Client::create($request->validated());

        return redirect()->route('clients.index')->with('success', __('Pomyślnie dodano klienta'));
    }

    public function edit(Client $client)
    {
        return view('client.edit', compact('client'));
    }

    public function update(Client $client, ClientRequest $request)
    {
        $client->update($request->validated());

        return redirect()->route('clients.index')->with('success', __('Pomyślnie zakutalizowano dane klienta'));
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')->with('success', __('Pomyślnie usunięto klienta'));
    }

    public function show(Client $client)
    {
        $client->load(['orders']);

        return view('client.show',  compact('client'));
    }
}
