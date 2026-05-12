<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'customer');
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }
        $users = $query->withCount('bookings')->latest()->paginate(20)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        // Calculate the total spent using the database directly for performance
        $totalSpent = $user->bookings()->sum('total_price');

        // Load the bookings with pagination
        $bookings = $user->bookings()->with('car')->latest()->paginate(10);
        
        // Pass the calculated total and the bookings to the view
        return view('admin.users.show', compact('user', 'bookings', 'totalSpent'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
        ]);
        $user->update($validated);
        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function toggleStatus(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
        $status = $user->is_active ? 'activated' : 'blocked';
        return back()->with('success', "User {$status} successfully.");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }
}
