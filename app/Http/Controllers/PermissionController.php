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
        $necessaryControllers = ['AuthController'];
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
        $controllerData = $this->getControllerMethods();
        return view('permissions.import',['controllerData' => $controllerData]);
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

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //
    }
    public function permission_import()
    {
        $controllerData = $this->getControllerMethods();
        foreach ($controllerData as $controller) {
            foreach ($controller['methods'] as $value) {
                $permission = new Permission();
                $permission->controller = class_basename($controller['controller']);
                $permission->action = $value;
                $permission->name = class_basename($controller['controller']) . " - " . $value;
                $permission->save();
            }
        }
        // Optionally redirect or return a response
        return redirect()->back()->with('success', 'Permissions imported successfully!');
    }
}
