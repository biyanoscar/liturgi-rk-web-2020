<?php

namespace App\Http\Controllers;

use App\Models\Choir;
use App\Models\ChoirMember;
use App\Models\User;
use Illuminate\Http\Request;

class ChoirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.choirs.index', [
            'choirs' => Choir::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.choirs.create', [
            'users' => User::all(),
        ]);
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
            'name' => 'required',
            'user_id' => 'required',
        ]);

        Choir::create($request->all());

        return redirect()->route('choirs.index')
            ->with('success-msg', 'Choir created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Choir  $choir
     * @return \Illuminate\Http\Response
     */
    public function show(Choir $choir)
    {
        $choirMembers = ChoirMember::where('choir_id', $choir->id)
            ->get();

        return view('admin.choir_members.index', ['choirMembers' => $choirMembers, 'choir' => $choir]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Choir  $choir
     * @return \Illuminate\Http\Response
     */
    public function edit(Choir $choir)
    {
        return view('admin.choirs.edit', [
            'choir' => $choir,
            'users' => User::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Choir  $choir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Choir $choir)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $choir->update($request->all());

        return redirect()->route('choirs.index')
            ->with('success-msg', 'Choir updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Choir  $choir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Choir $choir)
    {
        $choir->delete();

        return redirect()->route('choirs.index')
            ->with('success-msg', 'Choir deleted successfully');
    }
}
