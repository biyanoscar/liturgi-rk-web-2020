<?php

namespace App\Http\Controllers;

use App\Models\Choir;
use App\Models\ChoirMember;
use Illuminate\Http\Request;

class ChoirMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'name' => 'required',
            'no_kk' => 'required',
        ]);

        $request = $this->getCheckBoxValue($request, 'check_is_default', 'is_default');


        ChoirMember::create($request->all());

        return redirect()->route('choirs.show', $request['choir_id'])
            ->with('success-msg', 'Choir Member created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChoirMember  $choirMember
     * @return \Illuminate\Http\Response
     */
    public function show(ChoirMember $choirMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChoirMember  $choirMember
     * @return \Illuminate\Http\Response
     */
    public function edit(ChoirMember $choirMember)
    {
        return view('admin.choir_members.edit', compact('choirMember'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChoirMember  $choirMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChoirMember $choirMember)
    {
        $request->validate([
            'name' => 'required',
            'no_kk' => 'required',
        ]);

        $request = $this->getCheckBoxValue($request, 'check_is_default', 'is_default');


        $choirMember->update($request->all());
        // ChoirMember::create($request->all());

        return redirect()->route('choirs.show', $request['choir_id'])
            ->with('success-msg', 'Choir Member created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChoirMember  $choirMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChoirMember $choirMember)
    {
        $choirMember->delete();

        return redirect()->route('choirs.show', $choirMember->choir_id)
            ->with('success-msg', 'Choir Member deleted successfully');
    }

    public function createByParent(Choir $choir)
    {
        // dd($choir);
        return view('admin.choir_members.create_by_parent', ['choir' => $choir]);
    }

    //function untuk rubah centangan html jadi value field yg sesuai
    public function getCheckBoxValue($formData, $checkBoxName, $fieldName)
    {
        //rubah centangan html jadi value
        $formData[$fieldName] = isset($formData[$checkBoxName]) ? 1 : 0; //centang tampilkan kemuliaan
        unset($formData[$checkBoxName]); //dihilangkan, karena ini helper di form saja

        return $formData;
    }
}
