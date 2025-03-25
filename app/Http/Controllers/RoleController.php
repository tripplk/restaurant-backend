<?php
namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Fetch all roles
    public function index()
    {
        try {
            $roles = Role::all();  // Fetch all roles
            if ($roles->isNotEmpty()) {
                return response()->json($roles, 200);
            } else {
                return response()->json(["message" => "No roles found"], 404);
            }
        } catch (\Exception $e) {
            return response()->json(["error" => "Error fetching roles"], 500);
        }
    }

    // Create a new role
    public function createRole(Request $request)
    {
        // Fix typo "requireed" to "required"
        $validated = $request->validate([
            "name" => "required|string|max:255|unique:roles",
            "slug" => "required|string|max:255|unique:roles",
            "description" => "nullable|string|max:1000",
        ]);

        try {
            $role = new Role();
            $role->name = $request->name;
            $role->slug = $request->slug;
            $role->description = $request->description;

            $createdRole = $role->save();

            if ($createdRole) {
                return response()->json(["message" => "Role created successfully"], 201);
            } else {
                return response()->json(["message" => "Role not created"], 400);
            }
        } catch (\Exception $e) {
            return response()->json(["error" => "Error creating role"], 500);
        }
    }

    // Fetch a specific role by ID
    public function getRole($id)
    {
        try {
            $fetchedRole = Role::findOrFail($id);
            return response()->json($fetchedRole, 200);
        } catch (\Exception $e) {
            return response()->json(["error" => "Role not found"], 404);
        }
    }

    // Update an existing role
    public function updateRole(Request $request, $id)
    {
        // Fix typo "requireed" to "required"
        $validated = $request->validate([
            "name" => "required|string|max:255|unique:roles",
            "slug" => "required|string|max:255|unique:roles",
            "description" => "nullable|string|max:1000",
        ]);

        try {
            $roleToUpdate = Role::findOrFail($id);

            if ($roleToUpdate) {
                // Update role attributes
                $roleToUpdate->name = $validated['name'];
                $roleToUpdate->slug = $validated['slug'];
                $roleToUpdate->description = $validated['description'];

                $updatedRole = $roleToUpdate->save();

                if ($updatedRole) {
                    return response()->json(["message" => "Role updated successfully"], 200);
                } else {
                    return response()->json(["message" => "Role not updated"], 400);
                }
            }
        } catch (\Exception $e) {
            return response()->json(["error" => "Error updating role"], 500);
        }
    }

    // Delete a role by ID
    public function deleteRole($id)
    {
        try {
            $roleToDelete = Role::findOrFail($id);

            if ($roleToDelete) {
                $deletedRole = Role::destroy($id);

                if ($deletedRole) {
                    return response()->json(["message" => "Role deleted successfully"], 200);
                } else {
                    return response()->json(["message" => "Role not found or not deleted"], 404);
                }
            }
        } catch (\Exception $e) {
            return response()->json(["error" => "Error deleting role"], 500);
        }
    }
}
