<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { store } from '@/routes/password/confirm';
import { Form, Head, Link } from '@inertiajs/vue3'; // Añadido Head y Link
import { LoaderCircle } from 'lucide-vue-next';
import { useTranslations } from '@/composables/useTranslations'; // Añadido composable

const { __ } = useTranslations();
</script>

<template>
    <Head :title="__('Confirm password')">
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
                <!-- Header vacío -->
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

                        <!-- Título y Descripción -->
                        <div class="text-center mb-6">
                            <h1 class="text-lg font-semibold">{{ __('Confirm your password') }}</h1>
                            <p class="text-sm text-muted-foreground">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>
                        </div>

                        <!-- Formulario de Confirmación -->
                        <Form
                            v-bind="store.form()"
                            reset-on-success
                            v-slot="{ errors, processing }"
                        >
                            <div class="space-y-6">
                                <div class="grid gap-2">
                                    <Label htmlFor="password">{{ __('Password') }}</Label>
                                    <Input
                                        id="password"
                                        type="password"
                                        name="password"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="current-password"
                                        autofocus
                                    />
                                    <InputError :message="errors.password" />
                                </div>

                                <div class="flex items-center">
                                    <Button
                                        class="w-full"
                                        :disabled="processing"
                                        data-test="confirm-password-button"
                                    >
                                        <LoaderCircle
                                            v-if="processing"
                                            class="h-4 w-4 animate-spin"
                                        />
                                        {{ __('Confirm Password') }}
                                    </Button>
                                </div>
                            </div>
                        </Form>
                    </div>
                </div>
            </main>
        </div>

        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
