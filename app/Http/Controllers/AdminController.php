<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function users(Request $request)
    {
        $search = $request->get('search');
        $users = User::query()
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })
        ->paginate(10);
        foreach($users as $key => $user) {
            $users[$key]['role'] = Role::where('id', $user->role_id)->value('name');
        }
        return view('admin.users', compact('users'));
    }

    public function vacancies(Request $request)
    {
        $search = $request->get('search');
        $vacancies = Vacancy::with('user')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%");
            })->paginate(10);

        return view('admin.vacancies', compact('vacancies'));
    }
}
