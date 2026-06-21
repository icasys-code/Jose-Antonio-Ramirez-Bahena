# Plan detallado para crear las vistas de administrador

## 1. Objetivo
Crear un panel de administrador completo con CRUD (Crear, Leer, Actualizar, Eliminar) para las entidades principales del sistema. Incluir:
- rutas sin protección `auth`
- modelos Eloquent
- controladores de recursos
- vistas Blade para `index`, `create`, `show`, `edit`
- un layout principal con sidebar usando Tailwind CSS

## 2. Estructura recomendada

### 2.1 Rutas
Agregar un prefijo `/admin` y definir rutas de recursos para cada entidad.
Ejemplo en `routes/web.php`:

```php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('administrador.dashboard');
    })->name('admin.dashboard');

    Route::resource('users', UserController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategorieController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('warehouses', WarehouseController::class);
    // añadir más recursos según necesite: parts, orders, stocks, vendors, etc.
});
```

> Nota: No se debe usar middleware `auth` en estas rutas, por lo tanto cualquier visitante podrá acceder sin sesión iniciada.

### 2.2 Modelos
Crear o usar los modelos Eloquent existentes en `app/Models/`.
Cada modelo debe definir:
- `$fillable` con campos masivos asignables
- relaciones con otras entidades cuando aplique

Ejemplo de `User.php`:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
}
```

Ejemplo de `Warehouse.php`:

```php
class Warehouse extends Model
{
    protected $fillable = [
        'name',
        'location',
        'capacity',
    ];
}
```

### 2.3 Controladores
Crear controladores de recursos con métodos estándar:
- `index()` para listar registros
- `create()` para mostrar formulario de creación
- `store()` para guardar
- `show()` para ver detalles
- `edit()` para mostrar formulario de edición
- `update()` para actualizar
- `destroy()` para eliminar

Ejemplo básico de `UserController.php`:

```php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(15);
        return view('administrador.users.index', compact('users'));
    }

    public function create()
    {
        return view('administrador.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create($data);

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('administrador.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('administrador.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($data);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
```

## 3. Vistas Blade
Crear las vistas dentro de `resources/views/administrador/{entidad}/`.

### Estructura de carpetas
- `resources/views/administrador/plantilla.blade.php`
- `resources/views/administrador/dashboard.blade.php`
- `resources/views/administrador/users/index.blade.php`
- `resources/views/administrador/users/create.blade.php`
- `resources/views/administrador/users/edit.blade.php`
- `resources/views/administrador/users/show.blade.php`
- repetir para cada entidad: `brands`, `categories`, `vehicles`, `vendors`, etc.

### Contenido mínimo por vista
- `index`: tabla con botones `Editar`, `Ver`, `Eliminar`, enlace a `Crear`
- `create`: formulario para nuevos registros
- `edit`: formulario con datos existentes
- `show`: detalles de la entidad

## 4. Layout con sidebar usando Tailwind CSS
Crear un `administrador.plantilla` que envuelva todas las vistas de administrador.
Puede contener un sidebar fijo y un área central para contenido.

### Ejemplo de layout Tailwind

```blade
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Administrador')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-900">
    <div class="min-h-screen flex">
        <aside class="w-72 bg-slate-900 text-slate-100 flex flex-col shadow-lg">
            <div class="px-6 py-5 border-b border-slate-800">
                <h1 class="text-xl font-semibold">Admin Panel</h1>
                <p class="text-sm text-slate-400">Gestión de catálogo</p>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-700">Dashboard</a>
                <a href="{{ route('users.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-700">Usuarios</a>
                <a href="{{ route('brands.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-700">Marcas</a>
                <a href="{{ route('categories.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-700">Categorías</a>
                <a href="{{ route('vehicles.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-700">Vehículos</a>
                <a href="{{ route('warehouses.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-700">Almacenes</a>
            </nav>

            <div class="px-6 py-4 border-t border-slate-800 text-slate-400 text-sm">
                Acceso libre sin sesión.
            </div>
        </aside>

        <main class="flex-1 p-6">
            <header class="mb-6 flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-semibold">@yield('title', 'Panel Administrador')</h2>
                    <p class="text-sm text-slate-500">Gestione los datos del sistema sin autenticación</p>
                </div>
            </header>

            <section class="space-y-6">
                @yield('content')
            </section>
        </main>
    </div>
</body>
</html>
```

## 5. Pasos detallados de implementación

### 5.1 Crear las rutas
1. Abrir `routes/web.php`.
2. Añadir `Route::prefix('admin')->group(...)`.
3. Usar `Route::resource()` para cada controlador de administrador.
4. No añadir `->middleware('auth')`.

### 5.2 Crear o revisar modelos
1. Verificar que cada entidad tenga modelo en `app/Models/`.
2. Agregar `$fillable` y relaciones.
3. Si falta, generar con `php artisan make:model NombreModelo -m`.

### 5.3 Crear controladores de recursos
1. Generar con `php artisan make:controller NombreController --resource`.
2. Implementar validaciones dentro de `store()` y `update()`.
3. Retornar las vistas usando `view('administrador.entidad.index', compact('items'))`.
4. Usar `redirect()->route('entidad.index')` después de crear o actualizar.

### 5.4 Crear vistas
1. Crear `resources/views/administrador/plantilla.blade.php` con el layout de sidebar.
2. Crear `dashboard.blade.php` para la página inicial.
3. Crear la carpeta `administrador/{recurso}/` para cada entidad.
4. Definir `@extends('administrador.plantilla')`, `@section('title', ...)` y `@section('content')`.

### 5.5 Probar la navegación
1. Abrir `/admin` para ver el dashboard.
2. Abrir `/admin/users`, `/admin/brands`, etc.
3. Probar crear, ver, editar y eliminar registros.

## 6. Consideraciones adicionales
- Para entidades relacionales, usar `with()` en el controlador para cargar relaciones.
- En los formularios, mostrar mensajes de error con `@error('campo')`.
- En `destroy`, usar `method="POST"` y `@method('DELETE')` en el formulario.
- Mantener las rutas en singular/plural consistente con el nombre del recurso.

## 7. Ejemplo de vista `index`

```blade
@extends('administrador.plantilla')

@section('title', 'Usuarios - Panel Admin')

@section('content')
<div class="bg-white shadow rounded-xl p-6">
    <div class="mb-4 flex items-center justify-between">
        <h3 class="text-lg font-semibold">Lista de usuarios</h3>
        <a href="{{ route('users.create') }}" class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-sm text-white hover:bg-slate-700">Crear usuario</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-100 text-slate-700">
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-t">
                        <td class="px-4 py-3">{{ $user->id }}</td>
                        <td class="px-4 py-3">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('users.show', $user) }}" class="text-sky-600 hover:text-sky-800">Ver</a>
                            <a href="{{ route('users.edit', $user) }}" class="text-amber-600 hover:text-amber-800">Editar</a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
```

## 8. Conclusión
Con este plan, el proyecto tendrá un panel de administrador organizado, con rutas públicas, CRUD completo y una plantilla moderna con sidebar Tailwind. El siguiente paso es llevar cada sección del plan a código en la aplicación.
