<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
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
        return view('admin.roles.index', ['roles', Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.roles.create', ['permissions' => Permission::all()]);
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
                'name'=>'required|unique:roles|max:128',
            ]
        );

        $role = Role::create([
            'name' => $request['name']
        ]);

        $permissions_ids = $request['permissions'];

        if($permissions_ids) {
            foreach ($permissions_ids as $permission_id) {
                $permission = Permission::where('id', $permission_id)->firstOrFail();
                $role->givePermissionTo($permission);
            }
        }

        return redirect()->route('admin.roles.index')
            ->with('flash_message', 'Role '. $role->name . ' was added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return RedirectResponse
     */
    public function show(Role $role)
    {
        return redirect()->route('admin.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return View
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Role $role)
    {
        $validated_fields = $this->validate($request, [
            'name'=>'required|max:128|unique:roles,name,'.$role->id,
        ]);

        $role->fill($validated_fields)->save();

        $permissions_ids = $request['permissions'];

        if($permissions_ids) {
            // revoke all permissions first
            $role->permissions()->detach();

            // assign new permissions
            foreach ($permissions_ids as $permission_id) {
                $permission = Permission::where('id', $permission_id)->firstOrFail();
                $role->givePermissionTo($permission);
            }
        }

        return redirect()->route('admin.roles.index')
            ->with('flash_message', 'Role ' . $role->name . ' was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('flash_message', 'Role ' . $role->name . ' was deleted successfully!');
    }
}
