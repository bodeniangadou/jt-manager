<?php

namespace App\Http\Controllers;

use App\Models\Reportage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $stats = [
            'total_reportages' => Reportage::count(),
            'reportages_publies' => Reportage::where('est_publie', true)->count(),
            'reportages_brouillons' => Reportage::where('est_publie', false)->count(),
        ];

        if ($user->role === 'journaliste') {
            $stats['mes_reportages'] = Reportage::where('user_id', $user->id)->count();
            $stats['mes_publies'] = Reportage::where('user_id', $user->id)
                                           ->where('est_publie', true)
                                           ->count();
            $stats['derniers_reportages'] = Reportage::where('user_id', $user->id)
                                                    ->latest()
                                                    ->limit(5)
                                                    ->get();
        } else {
            $stats['total_utilisateurs'] = User::count();
            $stats['journalistes'] = User::where('role', 'journaliste')->count();
            $stats['admins'] = User::where('role', 'admin')->count();
            $stats['visiteurs'] = User::where('role', 'visiteur')->count();
            $stats['derniers_reportages'] = Reportage::latest()->limit(5)->get();
        }

        return view('dashboard.index', compact('stats'));
    }
}