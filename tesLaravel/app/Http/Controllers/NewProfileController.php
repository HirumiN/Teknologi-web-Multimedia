<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;




use Illuminate\Http\Request;

class NewProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $myName = "Muhammad Hilmi Nurullah";
        $myWork = "Mahasiswa PENS";
        $myTelp = "087861973639";
        $myBio = "Semoga semua yang kita impikan dan usahakan dengan baik akan berhasil";
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        return view('myprofile', compact('myName', 'myWork', 'myTelp', 'myBio','profile'));
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
        //
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
        //
    }
}
