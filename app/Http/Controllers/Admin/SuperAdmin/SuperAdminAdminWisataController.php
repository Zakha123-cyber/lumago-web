<?php

namespace App\Http\Controllers\Admin\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SuperAdminAdminWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adminWisata = User::where('role', 'adminwisata')
            ->with('tempatWisata')
            ->latest()
            ->paginate(10);

        return view('superadmin.admin-wisata.index', compact('adminWisata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.admin-wisata.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:15'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'adminwisata',
        ]);

        return redirect()->route('superadmin.admin-wisata.index')
            ->with('success', 'Admin Wisata berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $adminWisata = User::findOrFail($id);
        return view('superadmin.admin-wisata.edit', compact('adminWisata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $adminWisata = User::findOrFail($id);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'phone' => ['required', 'string', 'max:15'],
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['required', 'min:8', 'confirmed'];
        }

        $validated = $request->validate($rules);

        $adminWisata->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        if ($request->filled('password')) {
            $adminWisata->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect()
            ->route('superadmin.admin-wisata.index')
            ->with('success', 'Data Admin Wisata berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $adminWisata = User::findOrFail($id);
        $adminWisata->delete();

        return redirect()->route('superadmin.admin-wisata.index')
            ->with('success', 'Admin Wisata berhasil dihapus');
    }
}
