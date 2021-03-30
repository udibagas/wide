<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotspotUserRequest;
use App\Models\HotspotUser;
use Illuminate\Http\Request;

class HotspotUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return HotspotUser::when($request->keyword, function($q) use ($request) {
            $q->where(function($q) use ($request) {
                $q->where('field', 'like', "%{$request->keyword}%")
                    ->orWHere('field', 'like', "%{$request->keyword}%");
            });
        })->orderBy($request->sort_field ?: 'name', $request->sort_direction ?: 'asc')
            ->paginate($request->per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HotspotUserRequest $request)
    {
        $data = HotspotUser::create($request->all());
        return ['message' => 'Data has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HotspotUser  $hotspotUser
     * @return \Illuminate\Http\Response
     */
    public function show(HotspotUser $hotspotUser)
    {
        return $hotspotUser;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HotspotUser  $hotspotUser
     * @return \Illuminate\Http\Response
     */
    public function update(HotspotUserRequest $request, HotspotUser $hotspotUser)
    {
        $hotspotUser->update($request->all());
        return ['message' => 'Data has been saved'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HotspotUser  $hotspotUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotspotUser $hotspotUser)
    {
        $hotspotUser->delete();
        return ['message' => 'Data has been deleted'];
    }
}
