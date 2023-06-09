<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Coordinate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Support\Facades\Validator;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::first();
        return view('home.map.index', [
            'title' => 'Map'
        ], compact('company'));
    }

    public function storeCoordinate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'longitude' => ['required'],
            'latitude' => ['required'],
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validate();
        $coordinate = Coordinate::create($validatedData);

        Log::create([
            'user_id' => auth()->user()->id,
            'type' => 'success',
            'action' => 'store',
            'on' => 'Coordinate',
            'description' => "New Coordinate Markey $coordinate->name was successfully stored."
        ]);

        return redirect()->back()->with('message', "Data Coordinate <b>$coordinate->name</b> telah berhasil <b>ditambahkan!</b>");
    }

    public function json()
    {
        $results = DB::table('coordinates')->select('name', 'latitude', 'longitude')->get();
        return \json_encode($results);
    }
    
    public function index2()
    {
        $company = Company::first();
        return view('layouts.basic', [
            'title' => 'Map'
        ], compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
