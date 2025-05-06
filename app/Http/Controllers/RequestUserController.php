<?php

namespace App\Http\Controllers;

use App\Models\RequestUser;

class RequestUserController extends Controller
{
    public function index()
    {
        $requests = RequestUser::with('user')->where('status', 'PENDING')->get();
        return view('auth.verify', compact('requests'));
    }

    public function approve($id)
    {
        $requestUser = RequestUser::findOrFail($id);
        $requestUser->update(['status' => 'APPROVED']);

        return redirect()->route('request_users.index')->with('success', 'User approved successfully.');
    }

    public function decline($id)
    {
        $requestUser = RequestUser::findOrFail($id);
        $requestUser->update(['status' => 'DECLINED']);

        return redirect()->route('request_users.index')->with('success', 'User declined successfully.');
    }
}
