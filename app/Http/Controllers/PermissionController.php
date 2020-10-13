<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
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
        return view('admin.permissions.index', ['permissions', Permission::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.permissions.create')->with('roles', Role::all());
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
            'name'=>'required|max:128|unique:permissions',
        ]);

        $permission = Permission::create([
            'name' => $request['name']
        ]);

        $roles_ids = $request['roles'];

        if ($roles_ids) {
            foreach ($roles_ids as $role_id) {
                $role = Role::where('id', $role_id)->firstOrFail();

                $role->givePermissionTo($permission);
            }
        }

        return redirect()->route('admin.permissions.index')
            ->with('flash_message', 'Permission ' . $permission->name . ' was added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function show(Permission $permission)
    {
        return redirect()->route('admin.permissions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     * @return View
     */
    public function edit(Permission $permission)
    {
        $roles = Role::all();

        return view('admin.permissions.edit', compact('permission', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Permission $permission
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Permission $permission)
    {
        $validated_fields = $this->validate($request, [
            'name'=>'required|max:128|unique:permissions,name,'.$permission->id,
        ]);

        $permission->fill($validated_fields)->save();

        $selected_roles = $request['roles'];

        if ($selected_roles) {
            $permission->roles()->sync($selected_roles);
        } else {
            $permission->roles()->detach();
        }

        return redirect()->route('admin.permissions.index')
            ->with('flash_message', 'Permission '. $permission->name . ' was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('admin.permissions.index')
            ->with('flash_message', 'Permission ' . $permission->name . ' was deleted successfully!');
    }
}
