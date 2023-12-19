<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Http\Requests\StoreCourRequest;
use App\Http\Requests\UpdateCourRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cours = Cour::all();
        return view('cour.cours', compact('cours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Session::forget('success');

        return view('cour.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourRequest $request)
    {

        $cour = Cour::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'placesNumber' => $request->placesNumber,
            'completNameFormateur' => Auth::user()->name,
            'formateurId' => Auth::user()->id,

        ]);
        Session::flash('success');
        return view('cour.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cour $cour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cour $cour)
    {
        $cour = Cour::find($cour->id);

        return view('cour.edit', compact('cour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourRequest $request, Cour $cour)
    {
        $cour->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'placesNumber' => $request->placesNumber,
        ]);
        return redirect()->route('cours.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cour $cour)
    {
        $cour->delete();
        return redirect()->route('cours.index');
    }
}
