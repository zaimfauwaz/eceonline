<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(){
        $this->middleware(function ($request, $next) {
            if (Gate::denies('manage-users')) {
                abort(403, 'You do not have permission to access users management.');
            }
        return $next($request);
        });
    }

    public function index()
    {
        $users = User::orderBy('created_at', 'desc')
            ->paginate(12);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        return view('user.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,branch_id',
            'user_name' => 'required|string|max:255',
            'user_password' => 'required|string|min:8|confirmed',
            'user_email' => 'required|string|email|max:255|unique:users,email',
            'user_role' => 'required|integer|in:3,7,9',
        ]);

        User::create([
            'branch_id' => $request->branch_id,
            'name' => $request->user_name,
            'email' => $request->user_email,
            'role' => $request->user_role,
            'password' => bcrypt($request->user_password),
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $branches = Branch::all();
        return view('user.edit', compact(['user', 'branches']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'branch_id' => 'exists:branches,branch_id',
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|string|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
            'user_role' => 'required|integer|in:3,7,9',
        ]);

        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->role = $request->user_role;
        if ($request->branch_id) {
            $user->branch_id = $request->branch_id;
        } else {
            $user->branch_id = null;
        }
        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    /**
     * Show the form for changing the password.
     */
    public function password(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.password', compact('user'));
    }
    /**
     * Update the password of the specified resource in storage.
     */
    public function updatePassword(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('user.index')->with('success', 'Password updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
