<?php

namespace App\Http\Controllers;

use App\Models\Reportage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportageController extends Controller
{
    public function vitrine(Request $request)
    {
        $query = Reportage::with('user');

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('categorie') && $request->categorie !== 'all') {
            $query->where('categorie', $request->categorie);
        }

        $reportages = $query->orderBy('ordre_passage')->paginate(10);
        $categories = ['Politique', 'Économie', 'International', 'Sport'];

        return view('vitrine.index', compact('reportages', 'categories'));
    }

    public function index(Request $request)
    {
        $query = Reportage::with('user');

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('categorie') && $request->categorie !== 'all') {
            $query->where('categorie', $request->categorie);
        }

        if ($request->filled('journaliste') && $request->journaliste !== 'all') {
            $query->where('journaliste', $request->journaliste);
        }

        if (Auth::user()->role === 'journaliste') {
            $query->where('user_id', Auth::id());
        }

        $reportages = $query->orderBy('ordre_passage')->paginate(10);
        $categories = ['Politique', 'Économie', 'International', 'Sport'];
        $journalistes = User::where('role', 'journaliste')->pluck('name')->unique();

        return view('reportages.index', compact('reportages', 'categories', 'journalistes'));
    }

    public function create()
    {
        $journalistes = User::where('role', 'journaliste')->pluck('name', 'id');
        return view('reportages.create', compact('journalistes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'categorie' => 'required|in:Politique,Économie,International,Sport',
            'duree' => 'required|integer|min:1|max:600',
            'ordre_passage' => 'required|integer|unique:reportages,ordre_passage',
            'resume' => 'nullable|string',
            'est_publie' => 'sometimes|boolean',
        ]);

        if (Auth::user()->role === 'journaliste') {
            $validated['journaliste'] = Auth::user()->name;
            $validated['user_id'] = Auth::id();
        } else {
            $validated['journaliste'] = User::find($request->journaliste_id)->name;
            $validated['user_id'] = $request->journaliste_id;
        }

        $validated['est_publie'] = $request->has('est_publie');

        Reportage::create($validated);

        return redirect()->route('reportages.index')
            ->with('success', '✅ Reportage créé avec succès !');
    }

    public function show(Reportage $reportage)
    {
        return view('reportages.show', compact('reportage'));
    }

    public function edit(Reportage $reportage)
    {
        $journalistes = User::where('role', 'journaliste')->pluck('name', 'id');
        return view('reportages.edit', compact('reportage', 'journalistes'));
    }

    public function update(Request $request, Reportage $reportage)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'categorie' => 'required|in:Politique,Économie,International,Sport',
            'duree' => 'required|integer|min:1|max:600',
            'ordre_passage' => 'required|integer|unique:reportages,ordre_passage,' . $reportage->id,
            'resume' => 'nullable|string',
            'est_publie' => 'sometimes|boolean',
        ]);

        if (Auth::user()->role === 'admin' && $request->has('journaliste_id')) {
            $journaliste = User::find($request->journaliste_id);
            $validated['journaliste'] = $journaliste->name;
            $validated['user_id'] = $journaliste->id;
        }

        $validated['est_publie'] = $request->has('est_publie');

        $reportage->update($validated);

        return redirect()->route('reportages.index')
            ->with('success', '✅ Reportage mis à jour avec succès !');
    }

    public function destroy(Reportage $reportage)
    {
        $reportage->delete();
        return redirect()->route('reportages.index')
            ->with('success', '🗑️ Reportage supprimé avec succès !');
    }
}