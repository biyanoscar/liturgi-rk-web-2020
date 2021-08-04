<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganistRequest;
use App\Models\Organist;
use Illuminate\Http\Request;

class OrganistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.organists.index', [
            'organists' => Organist::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.organists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganistRequest $request)
    {
        auth()->user()->organists()->create( $request->all());

        return redirect()->route('organists.index')
            ->with('success-message', 'Organist created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organist  $organist
     * @return \Illuminate\Http\Response
     */
    public function show(Organist $organist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organist  $organist
     * @return \Illuminate\Http\Response
     */
    public function edit(Organist $organist)
    {
        return view('admin.organists.edit', [
            'organist' => $organist
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organist  $organist
     * @return \Illuminate\Http\Response
     */
    public function update(OrganistRequest $request, Organist $organist)
    {
        $organist->update($request->all());

        return redirect()->route('organists.index')
            ->with('success-message', 'Organist updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organist  $organist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organist $organist)
    {
        $organist->delete();

        return redirect()->route('organists.index')
            ->with('success-message', 'Organist deleted successfully!');
    }
}
