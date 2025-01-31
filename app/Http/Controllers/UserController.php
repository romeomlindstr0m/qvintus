<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Role;

class UserController extends Controller
{
    public function destroy(Request $request, string $id)
    {
        abort_if($id == Auth::id(), 403);

        $user = User::findOrFail($id);
        $user->delete();
        
        return back()->with('status', 'Successfully deleted the user');
    }

    public function edit(string $id): View
    {
        $roles_query = Role::all()->map(function ($role) {
            return [
                'name' => $role->name,
                'value' => $role->id,
            ];
        });

        $roles = $roles_query->toArray();

        $user = User::findOrFail($id);

        return view('user-edit')->with(['roles' => $roles, 'user' => $user]);
    }
}
