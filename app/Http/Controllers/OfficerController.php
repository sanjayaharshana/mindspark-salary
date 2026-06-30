<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class OfficerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of officer users.
     */
    public function index(Request $request)
    {
        $query = User::role('officer')->with('roles');
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('xelenic_id', 'like', "%{$search}%");
            });
        }
        $officers = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        $total = User::role('officer')->count();
        return view('admin.officers.index', compact('officers', 'total'));
    }

    /**
     * Show the form for creating a new officer.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.officers.create', compact('roles'));
    }

    /**
     * Store a newly created officer in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'xelenic_id' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'xelenic_id' => $request->xelenic_id,
        ]);

        // Assign officer role
        $user->assignRole('officer');

        return redirect()->route('admin.officers.index')->with('success', 'Officer created successfully!');
    }

    /**
     * Display the specified officer.
     */
    public function show(User $officer)
    {
        // Ensure the user has officer role
        if (!$officer->hasRole('officer')) {
            abort(404, 'Officer not found');
        }

        $officer->load('roles', 'permissions');
        return view('admin.officers.show', compact('officer'));
    }

    /**
     * Show the form for editing the specified officer.
     */
    public function edit(User $officer)
    {
        // Ensure the user has officer role
        if (!$officer->hasRole('officer')) {
            abort(404, 'Officer not found');
        }

        $roles = Role::all();
        $userRoles = $officer->roles->pluck('name')->toArray();
        return view('admin.officers.edit', compact('officer', 'roles', 'userRoles'));
    }

    /**
     * Update the specified officer in storage.
     */
    public function update(Request $request, User $officer)
    {
        // Ensure the user has officer role
        if (!$officer->hasRole('officer')) {
            abort(404, 'Officer not found');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $officer->id,
            'password' => 'nullable|string|min:8|confirmed',
            'xelenic_id' => 'nullable|string|max:255',
            'roles' => 'array',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'xelenic_id' => $request->xelenic_id,
        ];

        // Only update password if provided
        if ($request->password) {
            $updateData['password'] = Hash::make($request->password);
        }

        $officer->update($updateData);

        // Sync roles if provided
        if ($request->has('roles')) {
            $officer->syncRoles($request->roles);
        } else {
            // Ensure officer role is maintained
            if (!$officer->hasRole('officer')) {
                $officer->assignRole('officer');
            }
        }

        return redirect()->route('admin.officers.index')->with('success', 'Officer updated successfully!');
    }

    /**
     * Remove the specified officer from storage.
     */
    public function destroy(User $officer)
    {
        // Ensure the user has officer role
        if (!$officer->hasRole('officer')) {
            abort(404, 'Officer not found');
        }

        $officer->delete();
        return redirect()->route('admin.officers.index')->with('success', 'Officer deleted successfully!');
    }
}
