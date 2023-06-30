<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Log;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $clients = Client::all();
        $data = compact('clients');
        return view('clients.index', $data);
    }

    public function new()
    {
        return view('clients.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'phone' => 'required',
        ]);

        $client = new Client();
        $client->email = $request->email;
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->address = $request->address;

        $text = "Client " . $request->name . " created, datetime: " . now();
        Log::create(['text' => $text]);

        $client->save();
        return redirect('/clients')->with('success', 'Client created successfully');
    }

    public function edit($id)
    {
        $client = Client::find($id);
        return view('clients.edit', compact('client'));
    }

    public function update($id, Request $request)
    {
        $client = Client::find($id);
        $client->email = $request->email;
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();

        $text = "Client " . $client->name . " updated, datetime: " . now();
        Log::create(['text' => $text]);
        return redirect('/clients')->with('warning', 'Client updated successfully');
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        $text = "Client " . $client->name . " was deleted, datetime: " . now();
        $client->delete();
        Log::create(['text' => $text]);
        return redirect('/clients')->with('danger', "Client deleted successfully");
    }
}