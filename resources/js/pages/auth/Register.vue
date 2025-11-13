<script setup lang="ts">
import RegisteredUserController from '@/actions/App/Http/Controllers/Auth/RegisteredUserController';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { dashboard, login } from '@/routes'; // Import 'login' y 'dashboard'
import { Form, Head, Link } from '@inertiajs/vue3'; // Import 'Head' y 'Link'
import { LoaderCircle } from 'lucide-vue-next';
import { useTranslations } from '@/composables/useTranslations'; // Importar traducciones

const { __ } = useTranslations();

// NOTA: El formulario de la imagen tiene un campo 'phone' (teléfono)
// y NO tiene 'password'.
// Deberás ajustar tu 'RegisteredUserController' o el objeto 'Form'
// para que coincida con estos campos.
// He añadido 'phone' al formulario, pero puede que necesites
// añadirlo a tu lógica de 'RegisteredUserController.store.form()'
</script>

<template>
    <Head :title="__('Register')">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <div
        class="flex min-h-screen items-center justify-center bg-green-50 p-6 lg:p-8"
    >
        <div
            class="w-full max-w-6xl overflow-hidden rounded-2xl bg-white shadow-xl lg:grid lg:grid-cols-2"
        >
            <div class="relative hidden h-full lg:block">
                                <img
                    src="https://source.unsplash.com/random/800x900?business,laptop,office"
                    alt="Software de facturación"
                    class="h-full w-full object-cover"
                />
                <div
                    class="absolute bottom-0 left-0 w-full bg-black bg-opacity-60 p-8 text-white"
                >
                    <h3 class="mb-3 text-2xl font-bold">
                        Facturas con numeración automática
                    </h3>
                    <ul class="list-inside list-disc space-y-1 text-lg">
                        <li>Accede a las facturas desde cualquier lugar</li>
                        <li>Controla los pagos de tus clientes</li>
                    </ul>
                </div>
            </div>

            <main class="p-8 lg:p-12">
                <h1
                    class="mb-6 text-center text-2xl font-bold uppercase text-gray-700"
                >
                    Empieza gratis en menos de 1 minuto
                </h1>

                <Form
                    v-bind="RegisteredUserController.store.form()"
                    v-slot="{ errors, processing }"
                    class="flex flex-col gap-4"
                >
                    <div class="grid gap-4">
                        <div class="grid gap-1.5">
                            <Label for="name">{{ __('Nombre') }}</Label>
                            <Input
                                id="name"
                                type="text"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="name"
                                name="name"
                                :placeholder="__('Tu nombre...')"
                                class="border-gray-300"
                            />
                            <InputError :message="errors.name" />
                        </div>

                        <div class="grid gap-1.5">
                            <Label for="email">{{ __('Email') }}</Label>
                            <Input
                                id="email"
                                type="email"
                                required
                                :tabindex="2"
                                autocomplete="email"
                                name="email"
                                :placeholder="__('Tu email...')"
                                class="border-gray-300"
                            />
                            <InputError :message="errors.email" />
                        </div>

                        <div class="grid gap-1.5">
                            <Label for="phone">{{ __('Teléfono') }}</Label>
                            <Input
                                id="phone"
                                type="tel"
                                :tabindex="3"
                                autocomplete="tel"
                                name="phone"
                                :placeholder="__('Tu teléfono...')"
                                class="border-gray-300"
                            />
                            <InputError :message="errors.phone" />
                        </div>

                        <div class="flex items-start gap-3 pt-2">
                            <input
                                id="terms"
                                type="checkbox"
                                checked
                                class="mt-1 h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                            />
                            <label for="terms" class="text-sm text-gray-600">
                                He leído y acepto el
                                <TextLink
                                    href="#"
                                    class="font-medium text-blue-600 underline"
                                    >Aviso Legal</TextLink
                                >, la
                                <TextLink
                                    href="#"
                                    class="font-medium text-blue-600 underline"
                                    >Política de privacidad</TextLink
                                >
                                y los
                                <TextLink
                                    href="#"
                                    class="font-medium text-blue-600 underline"
                                    >Términos y Condiciones</TextLink
                                >.
                            </label>
                        </div>

                        <div class="flex items-start gap-3">
                            <input
                                id="newsletter"
                                type="checkbox"
                                checked
                                class="mt-1 h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                            />
                            <label for="newsletter" class="text-sm text-gray-600">
                                Deseo recibir el boletín electrónico así como
                                información o publicidad sobre productos y
                                promociones.
                            </label>
                        </div>

                        <Button
                            type="submit"
                            class="mt-4 w-full bg-yellow-500 py-3 text-base font-bold uppercase text-black shadow-md hover:bg-yellow-600"
                            tabindex="4"
                            :disabled="processing"
                            data-test="register-user-button"
                        >
                            <LoaderCircle
                                v-if="processing"
                                class="mr-2 h-5 w-5 animate-spin"
                            />
                            {{ __('REGISTRARSE') }}
                        </Button>
                    </div>
                </Form>

                <div class="mt-6 text-center text-sm text-muted-foreground">
                    {{ __('Already have an account?') }}
                    <TextLink
                        :href="login()"
                        class="underline underline-offset-4"
                        :tabindex="5"
                        >{{ __('Log in') }}</TextLink
                    >
                </div>
            </main>
        </div>
    </div>
</template>