<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.users.index', ['users', User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.users.create', ['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:128',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $selected_roles = $request['roles'];

        if ($selected_roles) {
            foreach ($selected_roles as $selected_role) {
                $user->assignRole($selected_role);
            }
        }

        return redirect()->route('admin.users.index')
            ->with('flash_message', 'User ' . $user->name . ' added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user)
    {
        return view('admin.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, User $user)
    {
        $required_fields = [
            'name'=>'required|max:128',
            'email'=>'required|email|unique:users,email,'.$user->id,
        ];

        if($request->filled('password')) {
            $required_fields['password'] ='min:6|confirmed';
        }

        $validated_fields = $this->validate($request, $required_fields);

        $selected_roles = $request['roles'];

        $user->fill($validated_fields)->save();

        if ($selected_roles) {
            $user->roles()->sync($selected_roles);
        } else {
            $user->roles()->detach();
        }

        return redirect()->route('admin.users.index')
            ->with('flash_message', 'User ' . $user->name . ' was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('flash_message', 'User ' . $user->name . ' was deleted successfully!');
    }
}
