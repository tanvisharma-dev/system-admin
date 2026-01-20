<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of active clients.
     */
    public function index()
    {
        $clients = Client::where('del_status', 0)->get();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created client in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name'    => 'required|string|max:255',
            'contact_person'  => 'required|string|max:255',
            'email'           => 'required|email|unique:clients,email',
            'phone'           => 'required|string|max:20',
            'password'        => 'required|string|min:6|confirmed',
            'billing_address' => 'required|string',
        ]);

        Client::create([
            'company_name'    => $request->company_name,
            'contact_person'  => $request->contact_person,
            'email'           => $request->email,
            'phone'           => $request->phone,
            'password_hash'   => Hash::make($request->password),
            'billing_address' => $request->billing_address,
            'status'          => 1,
            'del_status'      => 0,
        ]);

        return redirect()->route('admin.clients.index')->with('success', '✅ Client added successfully.');
    }

    /**
     * Show the form for editing the specified client.
     */
    public function edit(Client $client)
    {
        if ($client->del_status) {
            return redirect()->route('admin.clients.index')->with('error', 'Client not found.');
        }

        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified client in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'company_name'    => 'required|string|max:255',
            'contact_person'  => 'required|string|max:255',
            'email'           => 'required|email|unique:clients,email,' . $client->id,
            'phone'           => 'required|string|max:20',
            'billing_address' => 'required|string',
        ]);

        $client->update([
            'company_name'    => $request->company_name,
            'contact_person'  => $request->contact_person,
            'email'           => $request->email,
            'phone'           => $request->phone,
            'billing_address' => $request->billing_address,
        ]);

        return redirect()->route('admin.clients.index')->with('success', '✅ Client updated successfully.');
    }

    /**
     * Soft-delete the specified client.
     */
    public function destroy(Client $client)
    {
        $client->update(['del_status' => 1]);

        return redirect()->route('admin.clients.index')->with('success', '🗑️ Client deleted successfully.');
    }

    /**
     * Display the specified client's details.
     */
    public function show(Client $client)
    {
        if ($client->del_status) {
            return redirect()->route('admin.clients.index')->with('error', 'Client not found.');
        }

        return view('admin.clients.show', compact('client'));
    }
}
