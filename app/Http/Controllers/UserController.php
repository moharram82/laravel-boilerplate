<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use PasswordValidationRules;

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.users.index', ['users' => User::all()]);
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
            'name' => 'required|max:128',
            'email' => 'required|email|unique:users',
            'password' => $this->passwordRules(),
        ]);

        // create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // assign roles to created user
        if ($request['roles']) {
            foreach ($request['roles'] as $selected_role) {
                $user->assignRole($selected_role);
            }
        }

        // upload profile picture if submitted
        if($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('public/profiles');

            $user->profile_picture = $request->file('profile_picture')->hashName();
            $user->save();
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

        // check if password is filled then add password rules to validation rules array
        if($request->filled('password')) {
            $required_fields['password'] = $this->passwordRules();
        }

        // validate input
        $validated_fields = $this->validate($request, $required_fields);

        // check if password is filled then hash it
        if($request->filled('password')) {
            $validated_fields = array_merge($validated_fields, ['password' => Hash::make($validated_fields['password'])]);
        }

        // delete profile picture if checked
        if($request->delete_picture) {
            if ($user->profile_picture && Storage::exists('public/profiles/' . $user->profile_picture)) {
                Storage::delete('public/profiles/' . $user->profile_picture);
                $user->profile_picture = null;
            }
        }

        // update user
        $user->fill($validated_fields)->save();

        // if roles are submitted then sync them otherwise remove all roles
        if ($request['roles']) {
            $user->roles()->sync($request['roles']);
        } else {
            $user->roles()->detach();
        }

        // upload profile picture if submitted
        if($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('public/profiles');

            $user->profile_picture = $request->file('profile_picture')->hashName();
            $user->save();
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
        // check if user has profile picture then delete it
        if ($user->profile_picture) {
            Storage::delete('public/profiles/' . $user->profile_picture);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('flash_message', 'User ' . $user->name . ' was deleted successfully!');
    }
}
