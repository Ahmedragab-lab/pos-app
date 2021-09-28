<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::when($request->search,function($q)use($request){
          return $q->where('name','like','%'.$request->search.'%')
                   ->orWhere('phone','like','%'.$request->search.'%')
                   ->orWhere('address','like','%'.$request->search.'%');
        })->latest()->paginate(5);
        return view('clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:clients,name',
            'phone'=>'required|array|min:1',
            'phone.0'=>'required',
            'address'=>'required',
        ]);
        $input= $request->all();
        $input['phone'] = array_filter($request->phone);
        Client::create($input);
        session()->flash('Add', 'client added successfully');
        return redirect('clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'required|array|min:1',
            'phone.0'=>'required',
            'address'=>'required',
        ]);
        $input= $request->all();
        $input['phone'] = array_filter($request->phone);
        $client->update($input);
        session()->flash('Edit', 'client updated successfully');
        return redirect('clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        session()->flash('Delete', 'client Deleted successfully');
        return redirect('clients');
    }
}
