<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        [$message, $author] = str(Inspiring::quotes()->random())->explode('-');

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'quote' => ['message' => trim($message), 'author' => trim($author)],
            'auth' => [
                'user' => $request->user(),
            ],
            
            // --- BLOQUE DE TRADUCCIÓN AÑADIDO ---
            'translations' => function () {
                $locale = app()->getLocale(); // Obtiene el idioma actual

                // Carga el archivo JSON principal del idioma (ej. lang/es.json)
                $jsonTranslations = file_exists(lang_path("{$locale}.json"))
                    ? json_decode(file_get_contents(lang_path("{$locale}.json")), true)
                    : [];

                // Opcional: Cargar también archivos PHP (ej. lang/es/validation.php)
                $phpTranslations = [];
                if (file_exists(lang_path("{$locale}/validation.php"))) {
                    // Carga el array de validación bajo la clave 'validation'
                    $phpTranslations['validation'] = trans('validation', [], $locale);
                }
                
                // Devuelve un solo objeto fusionado
                return array_merge($jsonTranslations, $phpTranslations);
            },
            // --- FIN DEL BLOQUE AÑADIDO ---

            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
        ];
    }
}