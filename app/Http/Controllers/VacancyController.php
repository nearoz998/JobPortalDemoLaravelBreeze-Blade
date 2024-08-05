<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use function Laravel\Prompts\alert;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $vacancies = Vacancy::where('user_id', Auth::id())->get();
        // return view('vacancies.index', compact('vacancies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vacancies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string', 'max:2000'],
            'expiry' => ['required', 'date'],
        ]);

        Vacancy::create([
            'title' => $request->title,
            'description' => $request->description,
            'details' => $request->details,
            'expiry' => $request->expiry,
            'user_id' => auth()->user()->id
        ]);
        return Redirect::route('dashboard')->with('success', 'Vacancy added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacancy $vacancy)
    {
        return view('vacancies.show', compact('vacancy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacancy $vacancy)
    {
        return view('vacancies.edit', compact('vacancy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string'],
            'expiry' => ['required', 'date'],
        ]);

        $vacancy->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'details' => $request->input('details'),
            'expiry' => $request->input('expiry'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Vacancy updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
        if ($vacancy->user_id !== auth()->user()->id) {
            return Redirect::back()->with('warning', 'Unauthorized.');
        }
        $vacancy->delete();
        return redirect()->route('dashboard')->with('success', 'Vacancy deleted successfully!');
    }
}
