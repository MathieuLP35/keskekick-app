<?php

namespace App\Http\Controllers;

use App\Models\OwnedVehicle;
use App\Models\Phone;
use App\Models\UserF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = UserF::find($id);
        return view('players.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete user
        $user = DB::connection('mysql_second')->table('users')->where('identifier', $id)->first();
        $user->delete();

        // Delete user's phone
        $phone = DB::connection('mysql_second')->table('phone_phones')->where('owner', $id)->first();
        $phone->delete();

        return redirect()->route('dashboard');
    }
}
