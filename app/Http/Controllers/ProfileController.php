<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Profile::findOrFail($id);
        return view('profile.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'desa' => 'required|string|max:255',
            'email' => 'required|email|max:150',
        ]);

        $model = Profile::findOrFail($id);
        $model->fill($request->all());
        $model->save();

        return redirect()->route('home')->with('success', 'Profile berhasil diperbarui.');
    }
}
