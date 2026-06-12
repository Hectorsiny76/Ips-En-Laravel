# Plan de Refactorización — IPS-En-Laravel

> Proyecto: Mesa de Servicio ICONN  
> Stack: Laravel · Blade · PHP · Tailwind CSS v4  
> Objetivo: Limpiar, desacoplar y escalar la arquitectura para manejar múltiples tipos de sucursal (**Tienda** y **Estación**) sin condicionales `if` dispersos.

---

## 1. Diagnóstico del Estado Actual

| Área | Problema detectado |
|------|--------------------|
| `EstablecimientoController` | Query incompleta (`$centrocostos` indefinida); sin tipado; sin validación de Request |
| Vistas Blade | `welcome.blade.php` no se usa en producción; el layout real está en `main_layout/main.blade.php` |
| Componentes | `tabla-tienda-index` y `tabla-estacion-index` son casi idénticos — código duplicado |
| Modelos | `Establecimiento` concentra todo; no existe distinción por tipo a nivel de código |
| Rutas | Solo dos rutas; sin separación por tipo de sucursal |
| Lógica de tipo | El tipo se deduce implícitamente (por relaciones), no hay una abstracción explícita |
| Layout | Contiene CSS minificado embebido; links de navegación apuntan a IPs hardcodeadas |

---

## 2. Mejoras Propuestas

### 🔴 Críticas (corrigen bugs o errores actuales)
- [ ] Corregir typo `$centrocostos` → `$centrodecostos` en `EstablecimientoController@show`
- [ ] Añadir `FormRequest` con validación en lugar de leer `$request->input()` directo
- [ ] Proteger todas las queries con `try/catch` o usar `findOrFail`

### 🟡 Arquitectura (eliminan el `if` tipo-sucursal)
- [ ] Crear **Strategy Pattern** / clases derivadas para `Tienda` y `Estacion`
- [ ] Extraer un **`SucursalService`** que encapsule la lógica de búsqueda
- [ ] Usar **componentes Blade con `$attributes`** para tablas reutilizables
- [ ] Usar el campo `establecimientotipo` como key de configuración dinámica

### 🟢 Mantenibilidad
- [ ] Separar `Establecimiento` en scopes nombrados (ej. `scopeTiendas`, `scopeEstaciones`)
- [ ] Mover links de navegación hardcodeados a `config/navegacion.php`
- [ ] Eliminar CSS embebido en layouts; usar siempre `@vite`
- [ ] Unificar los dos layouts (`welcome.blade.php` vs `main_layout/main.blade.php`)

---

## 3. Archivos a Modificar

| Archivo | Cambio |
|---------|--------|
| `app/Http/Controllers/user/EstablecimientoController.php` | Corregir typo, añadir `Request` tipado, mover lógica a Service |
| `app/Models/Establecimiento.php` | Añadir scopes `scopeTiendas()` / `scopeEstaciones()` |
| `resources/views/main_layout/main.blade.php` | Mover links a config; limpiar CSS embebido |
| `resources/views/components/tabla-tienda-index.blade.php` | Reemplazar por componente genérico |
| `resources/views/components/tabla-estacion-index.blade.php` | Reemplazar por componente genérico |
| `routes/web.php` | Añadir rutas separadas por tipo de sucursal |

---

## 4. Archivos Nuevos a Crear

```
app/
├── Http/
│   └── Requests/
│       └── BuscarSucursalRequest.php        ← Validación de formulario
├── Services/
│   └── SucursalService.php                  ← Lógica de búsqueda centralizada
│
resources/views/
├── components/
│   ├── tabla-sucursal.blade.php             ← Tabla genérica y reutilizable
│   └── campo-info.blade.php                 ← Fila de detalle reutilizable
│
config/
└── navegacion.php                           ← Links de navegación configurables
```

---

## 5. Arquitectura Propuesta: Eliminar `if` por Tipo

### ❌ Antes (enfoque actual típico)

```php
// En el controlador
if ($tipo === 'tienda') {
    $columnas = ['numero', 'nombre', 'ip'];
    $vista = 'components.tabla-tienda-index';
} else {
    $columnas = ['nombre', 'centrodecostos', 'ip'];
    $vista = 'components.tabla-estacion-index';
}
```

```blade
{{-- En la vista --}}
@if($establecimiento->tipo === 'tienda')
    <x-tabla-tienda-index />
@else
    <x-tabla-estacion-index />
@endif
```

---

### ✅ Después (Strategy + componente genérico)

**`app/Services/SucursalService.php`**
```php
<?php

namespace App\Services;

use App\Models\Establecimiento;
use App\Http\Requests\BuscarSucursalRequest;

class SucursalService
{
    /**
     * Busca una sucursal filtrando por nombre y/o centro de costos.
     */
    public function buscar(BuscarSucursalRequest $request): ?Establecimiento
    {
        return Establecimiento::with([
                'campogerente',
                'establecimientotipo',
                'mercado',
                'campo',
            ])
            ->when($request->nombre, fn($q) =>
                $q->where('nombre', 'like', '%' . $request->nombre . '%')
            )
            ->when($request->centrodecostos, fn($q) =>
                $q->where('centrodecostos', 'like', '%' . $request->centrodecostos . '%')
            )
            ->when($request->numero, fn($q) =>
                $q->where('numero', $request->numero)
            )
            ->first();
    }

    /**
     * Devuelve la configuración de columnas según el tipo de sucursal.
     */
    public function columnas(Establecimiento $est): array
    {
        $tipo = optional($est->establecimientotipo)->nombre;

        return match(true) {
            str_contains(strtolower($tipo), 'estacion') => [
                ['key' => 'nombre',         'label' => 'Nombre'],
                ['key' => 'centrodecostos', 'label' => 'Centro de Costos'],
                ['key' => 'ip_servidor',    'label' => 'IP Servidor'],
            ],
            default => [ // tienda u otro
                ['key' => 'numero', 'label' => 'Número'],
                ['key' => 'nombre', 'label' => 'Nombre'],
                ['key' => 'ip_servidor', 'label' => 'IP'],
            ],
        };
    }
}
```

---

**`app/Http/Requests/BuscarSucursalRequest.php`**
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuscarSucursalRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nombre'         => ['nullable', 'string', 'max:255'],
            'numero'         => ['nullable', 'integer'],
            'centrodecostos' => ['nullable', 'string', 'max:100'],
        ];
    }
}
```

---

**`app/Http/Controllers/user/EstablecimientoController.php`** (refactorizado)
```php
<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuscarSucursalRequest;
use App\Services\SucursalService;

class EstablecimientoController extends Controller
{
    public function __construct(private SucursalService $service) {}

    public function index()
    {
        return view('user.main.index');
    }

    public function show(BuscarSucursalRequest $request)
    {
        $est      = $this->service->buscar($request);
        $columnas = $est ? $this->service->columnas($est) : [];

        return view('user.main.show', compact('est', 'columnas'));
    }
}
```

---

**`resources/views/components/tabla-sucursal.blade.php`** (componente genérico)
```blade
@props(['columnas' => [], 'filas' => []])

<div class="overflow-x-auto">
    <table class="w-full border-collapse border border-gray-300 text-sm">
        <thead class="bg-green-800 text-white">
            <tr>
                @foreach($columnas as $col)
                    <th class="border border-gray-300 px-4 py-2 text-left">
                        {{ $col['label'] }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($filas as $fila)
                <tr class="hover:bg-green-50 transition-colors">
                    @foreach($columnas as $col)
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $fila[$col['key']] ?? '—' }}
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columnas) }}"
                        class="px-4 py-6 text-center text-gray-400 italic">
                        Sin resultados
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
```

---

**Uso en `user/main/show.blade.php`**
```blade
@extends('main_layout.main')

@section('contenido')
    @if($est)
        <h2 class="text-xl font-bold mb-4">{{ $est->nombre }}</h2>
        <x-tabla-sucursal :columnas="$columnas" :filas="[$est->toArray()]" />
    @else
        <p class="text-gray-500">No se encontró la sucursal.</p>
    @endif
@endsection
```

---

## 6. Scopes en el Modelo `Establecimiento`

```php
// app/Models/Establecimiento.php  — añadir al final de la clase

/**
 * Filtra sólo establecimientos de tipo "tienda".
 */
public function scopeTiendas(Builder $query): Builder
{
    return $query->whereHas('establecimientotipo', fn($q) =>
        $q->where('nombre', 'like', '%tienda%')
    );
}

/**
 * Filtra sólo establecimientos de tipo "estación".
 */
public function scopeEstaciones(Builder $query): Builder
{
    return $query->whereHas('establecimientotipo', fn($q) =>
        $q->where('nombre', 'like', '%estacion%')
    );
}
```

Uso:
```php
Establecimiento::tiendas()->get();
Establecimiento::estaciones()->get();
```

---

## 7. Configuración de Navegación (eliminar IPs hardcodeadas)

**`config/navegacion.php`**
```php
<?php

return [
    'links' => [
        ['icono' => '👥', 'label' => 'Contactos',  'href' => env('NAV_CONTACTOS',  'http://10.60.200.8/MSI1N/complementos/contactos.html')],
        ['icono' => '🔼', 'label' => 'Escalación',  'href' => env('NAV_ESCALACION', 'http://10.60.200.8/MSI1N/complementos/index.html')],
        ['icono' => '📋', 'label' => 'TIDEL',       'href' => env('NAV_TIDEL',      'http://10.60.200.8/MSI1N/tidel/tidel.php')],
        ['icono' => '📑', 'label' => 'RITM',        'href' => env('NAV_RITM',       'http://10.60.200.8/MSI1N/ritms/listaRitm.php')],
    ],
];
```

En `main_layout/main.blade.php`:
```blade
@foreach(config('navegacion.links') as $link)
    <div class="border border-green-700 rounded-lg p-2 m-2 shadow-xl/20 hover:bg-green-600 transition-colors duration-300">
        <a href="{{ $link['href'] }}" target="_blank">
            <span>{{ $link['icono'] }}</span> {{ $link['label'] }}
        </a>
    </div>
@endforeach
```

---

## 8. Estructura de Carpetas Final Propuesta

```
app/
├── Http/
│   ├── Controllers/
│   │   └── user/
│   │       └── EstablecimientoController.php   ← [MODIFICAR] delega a Service
│   └── Requests/
│       └── BuscarSucursalRequest.php           ← [NUEVO] validación
├── Models/
│   └── Establecimiento.php                     ← [MODIFICAR] +scopes
└── Services/
    └── SucursalService.php                     ← [NUEVO] lógica de negocio

config/
└── navegacion.php                              ← [NUEVO] links configurables

resources/
└── views/
    ├── components/
    │   ├── tabla-sucursal.blade.php            ← [NUEVO] tabla genérica
    │   ├── campo-info.blade.php                ← [NUEVO] fila de detalle
    │   ├── tabla-tienda-index.blade.php        ← [ELIMINAR tras migrar]
    │   └── tabla-estacion-index.blade.php      ← [ELIMINAR tras migrar]
    ├── main_layout/
    │   └── main.blade.php                      ← [MODIFICAR] usar config()
    └── user/
        └── main/
            ├── index.blade.php                 ← formulario de búsqueda
            └── show.blade.php                  ← resultado con componente genérico
```

---

## 9. Pasos de Implementación (en orden)

### Fase 1 — Correcciones críticas (~ 30 min)
1. **Corregir** el typo `$centrocostos` → `$centrodecostos` en `EstablecimientoController@show`
2. Verificar que la query básica funcione correctamente

### Fase 2 — Capa de servicio (~ 1 h)
3. **Crear** `app/Http/Requests/BuscarSucursalRequest.php`
4. **Crear** `app/Services/SucursalService.php` con métodos `buscar()` y `columnas()`
5. **Refactorizar** `EstablecimientoController` para usar el servicio
6. Registrar `SucursalService` en `AppServiceProvider` si lo deseas como singleton

### Fase 3 — Componentes Blade (~ 1 h)
7. **Crear** `resources/views/components/tabla-sucursal.blade.php`
8. **Crear** `resources/views/components/campo-info.blade.php`
9. **Actualizar** `user/main/show.blade.php` para usar los nuevos componentes
10. Deprecar (luego eliminar) `tabla-tienda-index` y `tabla-estacion-index`

### Fase 4 — Modelo (~ 30 min)
11. **Añadir** scopes `scopeTiendas()` y `scopeEstaciones()` a `Establecimiento`
12. Usar los scopes en el `SucursalService`

### Fase 5 — Configuración y cleanup (~ 30 min)
13. **Crear** `config/navegacion.php`
14. **Actualizar** `main_layout/main.blade.php` para usar `config('navegacion.links')`
15. Agregar variables `NAV_*` al `.env.example`
16. Eliminar CSS embebido en los layouts (asegurar que `@vite` está siempre disponible)

### Fase 6 — Verificación
17. Prueba manual: buscar una tienda por nombre → tabla muestra columnas de tienda
18. Prueba manual: buscar una estación → tabla muestra columnas de estación
19. Verificar que no hay errores de variable indefinida en el controlador
20. Revisar el layout en distintos tamaños de pantalla con Tailwind

---

## 10. Notas Adicionales

- El proyecto usa `staudenmeir/eloquent-has-many-deep` y `znck/eloquent-traits` — mantener compatibilidad.
- `Establecimientotipo::nombre` es la clave para diferenciar sin hardcodear `if`s. Usar `match()` en el Service.
- `welcome.blade.php` es el stub de Laravel; puede borrarse o redirigir a `main.index`.
- La query en `show()` actualmente solo usa `first()` — considerar mostrar múltiples resultados con `get()` + paginación.
