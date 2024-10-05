<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

// normal search
// class UserController extends Controller
// {
//     public function index(Request $request)
//     {
//         if ($request->expectsJson()) {
//             $users = User::select(['id', 'name', 'email', 'created_at']);
//             return DataTables::of($users)->make(true);
//         }

//         return view('index');
//     }
// }

// filter dropdowns
class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $query = User::query();

            // Apply filters (if provided)
            if ($request->name) {
                $query->where('name', $request->name);
            }

            if ($request->email) {
                $query->where('email', $request->email);
            }

            return DataTables::of($query)->make(true);
        }

        return view('index');
    }

    // Method to provide unique values for dropdown filters
    public function filters()
    {
        $names = User::select('name')->distinct()->pluck('name');
        $emails = User::select('email')->distinct()->pluck('email');

        return response()->json([
            'names' => $names,
            'emails' => $emails
        ]);
    }
}

