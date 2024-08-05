<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $roleName = Role::where('id', $user->role_id)->value('name');

        if ($roleName == 'User') {
            $search = $request->input('search');
            $vacanciesQuery = Vacancy::with('user')
                ->where('expiry', '>=', today());

            if ($search) {
                $vacanciesQuery->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                });
            }

            $vacancies = $vacanciesQuery->paginate(10);

            return view('user.dashboard', compact('vacancies', 'search'));
        } elseif ($roleName == 'Company') {
            $search = $request->input('search');
            $vacanciesQuery = Vacancy::with('user')
                ->where('expiry', '>=', today())->where('user_id', Auth::id());

            if ($search) {
                $vacanciesQuery->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                });
            }

            $vacancies = $vacanciesQuery->paginate(10);

            return view('company.dashboard', compact('vacancies', 'search'));
        } elseif ($roleName == 'Admin') {
            return Redirect::route('admin.dashboard');
        }

        return redirect()->route('home');
    }
}
