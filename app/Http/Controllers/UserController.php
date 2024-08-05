<?php

namespace App\Http\Controllers;

use App\Helpers\ConstHelpers;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct(
        private User $user,
    ) {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
    }

    public function index()
    {
        $userAuth = auth()->user();

        $optionsRoles = ConstHelpers::OPTIONS_ROLES;

        return Inertia::render('Users/Index', [
            'users' => User::all(),
            'userAuth' => $userAuth,
            'optionsRoles' => $optionsRoles
        ]);
    }

    public function create(UserCreateRequest $request)
    {
        $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users');
    }

    public function update(UserUpdateRequest $request, $userId)
    {
        $user = User::findOrFail($userId);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users');
    }

    public function destroy($userId)
    {
        User::findOrFail($userId)->delete();

        return redirect()->route('users');
    }
}