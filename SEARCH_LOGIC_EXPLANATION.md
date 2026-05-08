# 🔍 Arquitectura de Búsqueda — Sistema de Sucursales

Este documento explica cómo funciona el flujo de búsqueda de tiendas y estaciones en el proyecto, detallando los archivos responsables de la lógica y su funcionamiento técnico.

------------------------------------------------------------------------------

## 1. El Controlador (El Director)
**Archivo:** `app/Http/Controllers/user/EstablecimientoController.php`

**Función:** Es el punto de entrada. Recibe la petición HTTP desde el formulario y coordina la respuesta.
*   **Inyección de Dependencias:** Utiliza el constructor para recibir el `SucursalService`, permitiendo que el controlador se mantenga limpio.
*   **Delegación:** En el método `show()`, no hace la búsqueda él mismo, sino que le pide al servicio que lo haga y luego decide qué vista mostrar con qué datos.

------------------------------------------------------------------------------

## 2. La Validación (El Portero)
**Archivo:** `app/Http/Requests/BuscarSucursalRequest.php`

**Función:** Protege la aplicación validando que los datos que el usuario envía por el formulario sean correctos.
*   **Reglas de Validación:** Define que el `nombre` sea un texto opcional, que el `numero` sea un entero, etc. 
*   **Seguridad:** Evita que se procesen datos maliciosos o con formatos incorrectos antes de que lleguen a la base de datos.

------------------------------------------------------------------------------

## 3. El Servicio (El Cerebro)
**Archivo:** `app/Services/SucursalService.php`

**Función:** Contiene la lógica de negocio real. Es el archivo más importante para modificar **cómo** se busca.
*   **Método `buscar()`:** Utiliza el método `when()` de Eloquent para aplicar filtros condicionales. Si un campo viene vacío, no lo incluye en la consulta SQL.
*   **Polimorfismo Visual:** El método `columnas()` decide dinámicamente qué campos mostrar en la tabla (ej. mostrar "Centro de Costos" solo si es una estación) sin necesidad de llenar las vistas de `if`.

------------------------------------------------------------------------------

## 4. El Modelo (La Fuente)
**Archivo:** `app/Models/Establecimiento.php`

**Función:** Representa la tabla `establecimientos` en la base de datos y define las conexiones con otras tablas.
*   **Relaciones:** Permite acceder a datos relacionados como `campogerente` o `mercado` de forma sencilla (Eager Loading).
*   **Scopes:** Define "atajos" de consulta como `scopeTiendas()` para filtrar rápidamente por tipo desde cualquier parte del código.

------------------------------------------------------------------------------

## 5. La Vista (La Interfaz)
**Archivo:** `resources/views/user/main/index.blade.php`

**Función:** Es el formulario que el usuario ve.
*   **Inputs:** Define los nombres de los campos (`name="nombre"`, `name="numero"`) que luego el controlador y el servicio utilizarán para filtrar.
*   **Rutas:** Envía los datos mediante el método `POST` a la ruta `user.main.show`.

------------------------------------------------------------------------------

## 💡 Resumen del Flujo Técnico
1. El usuario escribe en **index.blade.php**.
2. **BuscarSucursalRequest** valida los datos.
3. **EstablecimientoController** recibe la petición validada.
4. **SucursalService** ejecuta la consulta SQL en el modelo **Establecimiento**.
5. El resultado vuelve al controlador y se renderiza en **show.blade.php**.
