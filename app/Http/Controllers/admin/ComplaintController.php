<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HelpComplaint;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = HelpComplaint::latest()->paginate(10);
        return view('admin.complaints.index', compact('complaints'));
    }

    public function destroy($id)
    {
        $complaint = HelpComplaint::findOrFail($id);
        $complaint->delete();

        return redirect()->route('admin.complaints.index')->with('success', 'Data keluhan berhasil dihapus.');
    }
}
