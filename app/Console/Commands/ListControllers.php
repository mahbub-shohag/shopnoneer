// ListControllers.php

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use ReflectionClass;
use ReflectionMethod;

class ListControllers extends Command
{
protected $signature = 'list:controllers';
protected $description = 'List all necessary controllers and their CRUD methods';

public function handle()
{
$routes = Route::getRoutes();
$necessaryControllers = ['HousingController', 'DistrictController', 'DivisionController'];
$controllerData = [];

foreach ($routes as $route) {
$action = $route->getAction();

if (isset($action['controller'])) {
$controller = explode('@', $action['controller']);
$controllerClass = $controller[0];
$methodName = $controller[1] ?? null;

// Get only necessary controllers
$controllerName = class_basename($controllerClass);

if (in_array($controllerName, $necessaryControllers)) {
// Reflect the controller class to list methods
if (class_exists($controllerClass)) {
$reflection = new ReflectionClass($controllerClass);
$methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

$methodList = [];
foreach ($methods as $method) {
// Include only CRUD methods and your custom methods
if (in_array($method->name, ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']) || str_contains($method->name, 'custom')) {
$methodList[] = $method->name;
}
}

if (!empty($methodList)) {
$controllerData[] = [
'controller' => $controllerClass,
'methods' => $methodList,
];
}
}
}
}
}

// Return the filtered controller data for your Blade view
return view('role.create', compact('controllerData'));
}
}
