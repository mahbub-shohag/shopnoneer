<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use ReflectionClass;
use ReflectionMethod;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions.permission')->get();
        return view('role.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch necessary controllers and methods
        $controllerData = $this->getControllerMethods();

        // Pass the controller-method data to the 'role.create' view
        return view('role.create', [
            'controllerData' => $controllerData,
        ]);
    }

    /**
     * Get methods of necessary controllers.
     *
     * @return array
     */
    private function getControllerMethods()
    {
        // Retrieve all routes defined in the application
        $routes = Route::getRoutes()->get();
        // Specify the controllers you want to include
        $necessaryControllers = ['AuthController',
            'ConfirmablePasswordController',
            'ConfirmedPasswordStatusController',
            'ConfirmedTwoFactorAuthenticationController',
            'CsrfCookieController',
            'ExecuteSolutionController',
            'FilePreviewController',
            'FileUploadController',
            'FrontendAssets',
            'HandleRequests',
            'HealthCheckController',
            'NewPasswordController',
            'PasswordController',
            'PasswordResetLinkController',
            'RecoveryCodeController',
            'RegisteredUserController',
            'TwoFactorAuthenticatedSessionController',
            'TwoFactorAuthenticationController',
            'TwoFactorQrCodeController',
            'TwoFactorSecretKeyController',
            'UpdateConfigController'];
        $controllerData = [];

        // Loop through each route to gather controller methods
        foreach ($routes as $route) {
            $action = $route->getAction(); // Get the action associated with the route

            // Check if the route has a controller action defined
            if (isset($action['controller'])) {
                $controller = explode('@', $action['controller']); // Split the controller and method
                $controllerClass = $controller[0]; // Get the full class name
                $controllerName = class_basename($controllerClass); // Get just the class name

                // Filter controllers based on $necessaryControllers
                if (!in_array($controllerName, $necessaryControllers) && class_exists($controllerClass)) {
                    // Ensure the controller is not already added to the $controllerData array
                    if (!isset($controllerData[$controllerName])) {
                        $reflection = new \ReflectionClass($controllerClass); // Create a reflection class instance
                        // Get all methods of the class, without filtering by visibility
                        $methods = $reflection->getMethods();
                        $controllerMethods = [];

                        // Loop through each method to collect their names
                        foreach ($methods as $method) {
                            // Here, we're adding every method, including CRUD and custom methods
                            $controllerMethods[] = $method->name; // Collect method names without filtering
                        }

                        // Store the controller class and its methods in the controllerData array
                        $controllerData[$controllerName] = [
                            'controller' => $controllerClass,
                            'methods' => $controllerMethods,
                        ];
                    }
                }
            }
        }
        //echo "<pre>";print_r($controllerData);exit;

        // Re-index the array to return a simple numerically indexed array

        return array_values($controllerData);
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array', // Ensure that permissions is an array
            'permissions.*' => 'string', // Each permission must be a string
        ]);

        // Create a new Role instance
        $role = new Role();
        $role->name = $request->name;

        // Save the role
        if ($role->save()) {
            // Attach the selected permissions to the role
            if ($request->has('permissions')) {
                foreach ($request->permissions as $permission) {
                    // Split the permission value into controller and method
                    list($controller, $method) = explode('@', $permission);
                    // Create a new RolePermission entry
                    $rolePermission = new RolePermission();
                    $rolePermission->role_id = $role->id; // Set the role ID
                    $rolePermission->permission_id = Permission::where('controller', $controller)
                        ->where('action', $method)
                        ->first()->id; // Fetch the permission ID based on controller and method
                    $rolePermission->save(); // Save the RolePermission entry
                }
            }

            // Redirect back with a success message
            return redirect()->route('roles.index')->with('message', 'Role created successfully');
        } else {
            // Redirect back with an error message
            return redirect()->route('roles.create')->with('message', 'Role could not be created');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role = Role::with('permissions.permission')->findOrFail($role->id);
        return view('role.show', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('controller')->get();
        $rolePermissions = $role->permissions->pluck('permission_id')->toArray();
        return view('role.edit', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'array|required',
            'permissions.*' => 'integer|exists:permissions,id', // Validate permissions
        ]);

        // Sync role permissions
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('message', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->permissions()->delete(); // Delete associated permissions
        $role->delete(); // Delete the role
        return redirect()->route('roles.index')->with('message', 'Role deleted successfully');
    }
}
