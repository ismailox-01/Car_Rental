<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware; // استيراد الواجهة

class ProfileController extends Controller implements HasMiddleware // تفعيل الواجهة
{
    /**
     * تعريف الميدل وير في Laravel 11
     */
    public static function middleware(): array
    {
        return [
            'auth', // تطبيق حماية تسجيل الدخول
        ];
    }

    public function show()
    {
        $user = auth()->user();
        $activeBookings = $user->activeBookings()->with('car.primaryImage')->latest()->get();
        $pastBookings   = $user->pastBookings()->with('car.primaryImage')->latest()->take(5)->get();

        return view('profile.show', compact('user', 'activeBookings', 'pastBookings'));
    }

    public function edit()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'phone'          => 'nullable|string|max:20',
            'address'        => 'nullable|string|max:500',
            'license_number' => 'nullable|string|max:50',
            'id_card_image'         => 'nullable|image|max:5120',
            'driving_license_image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('avatar')) {
            $request->validate(['avatar' => 'image|max:2048']);
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }

        if ($request->hasFile('id_card_image')) {
            $path = $request->file('id_card_image')->store('documents', 'public');
            $validated['id_card_image'] = $path;
        }

        if ($request->hasFile('driving_license_image')) {
            $path = $request->file('driving_license_image')->store('documents', 'public');
            $validated['driving_license_image'] = $path;
        }

        $user->update($validated);

        if ($request->filled('return_to')) {
            return redirect($request->return_to)->with('success', 'Profile updated! You can now continue your booking.');
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}