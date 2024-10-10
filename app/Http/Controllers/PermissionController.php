<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
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
    public function index()
    {
        $controllerData = $this->getControllerMethods();
        $permissions = Permission::all();
        return view('permissions.index',['permissions'=>$permissions,'controllerData' => $controllerData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $controllerData = $this->getControllerMethods();
        return view('permissions.create',['controllerData' => $controllerData]);
    }
    public function import()
    {
        // Get all controller methods
        $controllerData = $this->getControllerMethods();

        // Retrieve existing permissions from the database
        $existingPermissions = Permission::all();

        // Filter controllerData to only include methods that are not in the database
        $filteredControllerData = array_filter($controllerData, function ($controller) use ($existingPermissions) {
            $controllerName = class_basename($controller['controller']);
            $newMethods = [];

            // Loop through the controller's methods
            foreach ($controller['methods'] as $method) {
                // Check if the permission already exists in the database
                $exists = $existingPermissions->contains(function ($permission) use ($controllerName, $method) {
                    return $permission->controller == $controllerName && $permission->action == $method;
                });

                // If the permission does not exist, add it to the list of new methods
                if (!$exists) {
                    $newMethods[] = $method;
                }
            }

            // Only return the controller if it has new methods to add
            if (!empty($newMethods)) {
                $controller['methods'] = $newMethods;
                return $controller;
            }
            return null;
        });

        // Pass the filtered controller data to the view
        return view('permissions.import', ['controllerData' => $filteredControllerData]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->controller = $request->controller;
        $permission->action = $request->action;
        $permission->save();
        $permissions = Permission::all();
        return view('permissions.index',['permissions'=>$permissions]);
    }


    public function permission_import()
    {
        $controllerData = $this->getControllerMethods();

        foreach ($controllerData as $controller) {
            foreach ($controller['methods'] as $value) {
                // Prepare data for checking or creating permission
                $controllerName = class_basename($controller['controller']);
                $action = $value;
                $name = $controllerName . " - " . $action;

                // Check if the permission already exists before saving
                Permission::firstOrCreate(
                    [
                        'controller' => $controllerName,
                        'action' => $action
                    ],
                    [
                        'name' => $name
                    ]
                );
            }
        }

        // Optionally redirect or return a response
        return redirect()->route('permissions.index')->with('success', 'Permissions imported successfully!');

    }

}
