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
        // Validasi jumlah anggota yg diset sebagai default max 5 orang
        if ($request->check_is_default == 'on') {
            $defaultCounts = ChoirMember::where('choir_id', $request->choir_id)->where('is_default', 1)->count();
            // dd($defaultCounts);
            if ($defaultCounts >= 5) {
                session()->flash('error-message', 'Default jumlah orang yang tugas maksimum 5. Silahkan hilangkan centang');
                return redirect()->back()->withInput();
            }
        }

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
        // Validasi jumlah anggota yg diset sebagai default max 5 orang
        if (($request->check_is_default == 'on') and ($request->old_is_default == 0)) {
            $defaultCounts = ChoirMember::where('choir_id', $request->choir_id)->where('is_default', 1)->count();
            if ($defaultCounts >= 5) {
                session()->flash('error-message', 'Default jumlah orang yang tugas maksimum 5. Silahkan hilangkan centang');
                return redirect()->back()->withInput();
            }
        }

        unset($request['old_is_default']); //unset helper old input

        $request->validate([
            'name' => 'required',
            'no_kk' => 'required',
        ]);

        $request = $this->getCheckBoxValue($request, 'check_is_default', 'is_default');


        $choirMember->update($request->all());
        // ChoirMember::create($request->all());

        return redirect()->route('choirs.show', $request['choir_id'])
            ->with('success-msg', 'Choir Member updated successfully.');
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
        $defaultCounts = ChoirMember::where('choir_id', $choir->id)->where('is_default', 1)->count();
        $checkedDefaultStyle = '';
        if ($defaultCounts < 5) {
            $checkedDefaultStyle = 'checked';
        }
        // dd($checkedDefaultStyle);

        return view('admin.choir_members.create_by_parent', ['choir' => $choir, 'checkedDefaultStyle' => $checkedDefaultStyle]);
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
