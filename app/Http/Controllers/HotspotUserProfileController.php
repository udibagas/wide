<?php

namespace App\Http\Controllers;

use App\Models\HotspotUserProfile;
use Illuminate\Http\Request;

class HotspotUserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return HotspotUserProfile::orderBy('name')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HotspotUserProfile::create($request->all());
        return ['message' => 'Data has been saved'];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HotspotUserProfile  $hotspotUserProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HotspotUserProfile $hotspotUserProfile)
    {
        $hotspotUserProfile->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HotspotUserProfile  $hotspotUserProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotspotUserProfile $hotspotUserProfile)
    {
        $hotspotUserProfile->delete();
    }
}
