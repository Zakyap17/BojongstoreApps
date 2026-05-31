<?php

namespace App\Http\Controllers;

use App\Models\HelpComplaint;
use Illuminate\Http\Request;

class HelpComplaintController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $complaint = HelpComplaint::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Keluhan berhasil disimpan.',
            'data' => $complaint
        ], 201);
    }
}
