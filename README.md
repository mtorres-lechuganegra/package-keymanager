# Lechuga Negra - KeyManager para Laravel

Este paquete de Laravel permite generar y validar llaves de acceso externas (API keys) para controlar el acceso público limitado a rutas. Incluye servicios para la gestión de llaves y un middleware que protege endpoints, facilitando integraciones seguras con entidades externas.

## Características Principales

* **Gestión de Keys:** Gestiona las llaves por entidad, facilitando la generación de token únicos para la validación de middlewares.
* **Middleware de Validación:** Valida las llaves generadas (token) para permitir el acceso a las rutas que están dentro de la capa de middlware de `api.key`.

## Instalación

1.  **Crear grupo de paquetes:**

    Crear la carpeta packages en la raíz del proyecto e ingresar a la carpeta:

    ```bash
    mkdir packages
    cd packages
    ```

    Crear el grupo de carpetas dentro de la carpeta creada, e ingresar a l carpeta:
    
    ```bash
    mkdir lechuganegra
    cd lechuganegra
    ```

2.  **Clonar el paquete:**

    Clonar el paquete en el grupo de carpetas creado y renombrarlo para que el Provider pueda registrarlo en la instalación

    ```bash
    git clone https://github.com/mtorres-lechuganegra/package-keymanager.git keymanager
    ```

3.  **Configurar composer del proyecto:**

    Dirígite a la raíz de tu proyecto, edita tu archivo `composer.json` y añade el paquete como repositorio:

    ```json
    {
        "repositories": [
            {
                "type": "path",
                "url": "packages/lechugaNegra/keymanager"
            }
        ]
    }
    ```
    también deberás añadir el namespace del paquete al autoloading de PSR-4:

    ```json
    {
        "autoload": {
            "psr-4": {
                "LechugaNegra\\KeyManager\\": "packages/LechugaNegra/KeyManager/src/"
            }
        }
    }
    ```

4.  **Ejecutar composer require:**

    Después de editar tu archivo, abre tu terminal y ejecuta el siguiente comando para agregar el paquete a las dependencias de tu proyecto:

    ```bash
    composer require lechuganegra/keymanager:@dev
    ```

    Este comando descargará el paquete y actualizará tu archivo `composer.json`.

5.  **Configurar el modelo de usuario (opcional):**

    Puedes editar el archivo `config/keymanager.php` y modifica la entrada `user_entity` con la información de tu modelo:

    ```php
    'user_entity' => [
        'model' => App\Models\User::class, // Reemplaza con tu modelo
        'table' => 'users' // Reemplaza con el nombre de tu tabla
    ],
    ```

5.  **Ejecutar las migraciones:**

    Ejecuta las migraciones del paquete para crear las tablas necesarias en la base de datos:

    ```bash
    php artisan migrate --path=packages/lechuganegra/keymanager/src/Database/Migrations
    ```

6.  **Limpiar la caché:**

    Limpia la caché de configuración y rutas para asegurar que los cambios se apliquen correctamente:

    ```bash
    php artisan config:clear
    php artisan config:cache
    php artisan route:clear
    php artisan route:cache
    ```
    
9.  **Regenerar clases:**

    Regenerar las clases con el cargador automático "autoload"

    ```bash
    composer dump-autoload
    ```

## Uso

### Middleware de Validación

Para proteger tus rutas con el middleware de validación de llaves, utiliza `api.key` en tus definiciones de rutas:

```php
Route::middleware(['api.key'])->group(function () {
    // Rutas protegidas
});
```
