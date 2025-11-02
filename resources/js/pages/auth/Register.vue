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
</script>

<template>
    <Head :title="__('Register')">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <div
        class="flex min-h-screen flex-col items-center bg-[var(--background)] text-[var(--foreground)] p-6 lg:justify-center lg:p-8 transition-colors duration-500"
    >
        <header
            class="mb-6 w-full max-w-[335px] lg:max-w-lg flex items-center justify-end"
        >
            <nav class="flex items-center justify-end gap-4 text-sm h-16">
                <!-- Puedes añadir un enlace a Dashboard si el usuario ya estuviera logueado, aunque es raro en Register -->
            </nav>
        </header>

        <div
            class="flex w-full items-center justify-center opacity-100 transition-opacity duration-700 lg:grow starting:opacity-0"
        >
            <main
                class="w-full max-w-[335px] overflow-hidden rounded-2xl lg:max-w-lg shadow-[0_8px_30px_rgba(0,0,0,0.08)] bg-[var(--card)] text-[var(--card-foreground)] transition-colors duration-500"
            >
                <div
                    class="relative p-8 text-[14px] leading-relaxed lg:p-16 flex flex-col justify-center overflow-hidden"
                >
                    <div>
                        <!-- Logo -->
                        <img
                            src="/img/facture.png"
                            alt="FactureOnCloud Logo"
                            class="h-16 w-auto mb-6 mx-auto"
                        />

                        <!-- Título y Descripción (Opcional, ya que el logo es claro) -->
                        <div class="text-center mb-6">
                            <h1 class="text-lg font-semibold">{{ __('Create an account') }}</h1>
                            <p class="text-sm text-muted-foreground">{{ __('Enter your details below to create your account') }}</p>
                        </div>


                        <!-- Formulario de Registro -->
                        <Form
                            v-bind="RegisteredUserController.store.form()"
                            :reset-on-success="['password', 'password_confirmation']"
                            v-slot="{ errors, processing }"
                            class="flex flex-col gap-6"
                        >
                            <div class="grid gap-6">
                                <div class="grid gap-2">
                                    <Label for="name">{{ __('Name') }}</Label>
                                    <Input
                                        id="name"
                                        type="text"
                                        required
                                        autofocus
                                        :tabindex="1"
                                        autocomplete="name"
                                        name="name"
                                        :placeholder="__('Full name')"
                                    />
                                    <InputError :message="errors.name" />
                                </div>

                                <div class="grid gap-2">
                                    <Label for="email">{{ __('Email address') }}</Label>
                                    <Input
                                        id="email"
                                        type="email"
                                        required
                                        :tabindex="2"
                                        autocomplete="email"
                                        name="email"
                                        :placeholder="__('email@example.com')"
                                    />
                                    <InputError :message="errors.email" />
                                </div>

                                <div class="grid gap-2">
                                    <Label for="password">{{ __('Password') }}</Label>
                                    <Input
                                        id="password"
                                        type="password"
                                        required
                                        :tabindex="3"
                                        autocomplete="new-password"
                                        name="password"
                                        :placeholder="__('Password')"
                                    />
                                    <InputError :message="errors.password" />
                                </div>

                                <div class="grid gap-2">
                                    <Label for="password_confirmation">{{ __('Confirm password') }}</Label>
                                    <Input
                                        id="password_confirmation"
                                        type="password"
                                        required
                                        :tabindex="4"
                                        autocomplete="new-password"
                                        name="password_confirmation"
                                        :placeholder="__('Confirm password')"
                                    />
                                    <InputError :message="errors.password_confirmation" />
                                </div>

                                <Button
                                    type="submit"
                                    class="mt-2 w-full"
                                    tabindex="5"
                                    :disabled="processing"
                                    data-test="register-user-button"
                                >
                                    <LoaderCircle
                                        v-if="processing"
                                        class="h-4 w-4 animate-spin"
                                    />
                                    {{ __('Create account') }}
                                </Button>
                            </div>

                            <div class="text-center text-sm text-muted-foreground">
                                {{ __("Already have an account?") }}
                                <TextLink
                                    :href="login()"
                                    class="underline underline-offset-4"
                                    :tabindex="6"
                                    >{{ __('Log in') }}</TextLink
                                >
                            </div>
                        </Form>
                    </div>
                </div>
            </main>
        </div>

        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
