import { usePage } from '@inertiajs/vue3';

/**
 * Composable para manejar las traducciones de Inertia.
 */
export function useTranslations() {
    
    // Obtenemos las 'translations' que pasamos desde HandleInertiaRequests.php
    const translations = (usePage().props.translations as Record<string, string>) || {};

    /**
     * Helper de traducción.
     * @param key La llave de traducción (ej. "Welcome")
     * @param replacements Un objeto de reemplazos (ej. { name: "David" })
     */
    const __ = (key: string, replacements: Record<string, string | number> = {}): string => {
        let translation: string = translations[key] || key;

        Object.keys(replacements).forEach(r => {
            translation = translation.replace(`:${r}`, String(replacements[r]));
        });

        return translation;
    };

    return { __ };
}