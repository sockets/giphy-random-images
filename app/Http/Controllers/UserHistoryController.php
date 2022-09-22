<?php

namespace App\Http\Controllers;

use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHistoryController extends Controller
{
    
    public function index()
    {
        // Get latest history logs from the authenticated user with pagination
        $userHistory = UserHistory::where("user", "=", Auth::id())->orderByDesc('id')->paginate(6);

        // Return page view with history data
        return view('history', compact('userHistory'));
    }

    public function destroy(Request $request)
    {
        // Check for history id
        if (!isset($request->id)) return response()->json(['error' => 'Missing ID'], 400);

        // Find entry
        $log = UserHistory::find($request->id);

        // Check for entry
        if ($log == null) return back()->with(['status' => 'Log Missing!']);

        // Check if user owns entry
        if ($log->user != Auth::id()) return response()->json(['error' => 'Invalid Permissions'], 401);

        // Delete Entry
        $log->delete();

        // Return Success
        return back()->with(['status' => 'Deleted History Log!']);
    }
}
