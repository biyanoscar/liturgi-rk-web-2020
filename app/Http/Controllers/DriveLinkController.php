<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriveLinkRequest;
use Exception;
use App\Models\DriveLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\DriveLinkRepository;

class DriveLinkController extends Controller
{
    protected $repository;

    public function __construct(DriveLinkRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.drive_links.index', [
            'links' => $this->repository->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.drive_links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DriveLinkRequest $request)
    {
        try {
            $link = $this->repository->store($request);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->withErrors('Drive link cannot be created!');
        }

        return redirect()
            ->route('drive-links.index')
            ->withSuccess("Successfully insert drive link $link->name");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DriveLink  $driveLink
     * @return \Illuminate\Http\Response
     */
    public function show(DriveLink $driveLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DriveLink  $driveLink
     * @return \Illuminate\Http\Response
     */
    public function edit(DriveLink $driveLink)
    {
        return view('admin.drive_links.edit', [
            'driveLink' => $driveLink
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DriveLink  $driveLink
     * @return \Illuminate\Http\Response
     */
    public function update(DriveLinkRequest $request, DriveLink $driveLink)
    {
        try {
            $link = $this->repository->update($driveLink->id,$request);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->withErrors('Drive link cannot be updated!');
        }

        return redirect()
            ->route('drive-links.index')
            ->withSuccess("Successfully update drive link $link->name");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DriveLink  $driveLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(DriveLink $driveLink)
    {
        try {
            $this->repository->delete($driveLink->id);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->withErrors('Drive link cannot be deleted!');
        }

        return redirect()
            ->route('drive-links.index')
            ->withSuccess("Successfully delete drive link");
    }
}
