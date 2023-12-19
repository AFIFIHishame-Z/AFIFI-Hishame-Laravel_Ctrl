<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Models\CourParticulier;
use App\Http\Requests\StoreCourParticulierRequest;
use App\Http\Requests\UpdateCourParticulierRequest;
use Illuminate\Support\Facades\Auth;

class CourParticulierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Cour $cour)
    {
        $particuliers = CourParticulier::where('courId', $cour->id)->get();
        return view('cour.particuliers', compact('particuliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourParticulierRequest $request)
    {
        $cour = Cour::find($request->courId);
        $particuliers = CourParticulier::where('courId', $request->courId)->get();

        if ($cour->placesNumber == $particuliers->count()) {
            return redirect()->route('cours.index');
        }

        if ($particuliers->contains('userId', Auth::user()->id)) {
            return redirect()->route('cours.index');
        }

        $courParticulier = CourParticulier::create([
            'userId' => Auth::user()->id,
            'courId' => $request->courId,
        ]);

        return redirect()->route('cours.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(CourParticulier $courParticulier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourParticulier $courParticulier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourParticulierRequest $request, CourParticulier $courParticulier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourParticulier $courParticulier)
    {
        //
    }
}
