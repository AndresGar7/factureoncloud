<script setup lang="ts">
import PasswordResetLinkController from '@/actions/App/Http/Controllers/Auth/PasswordResetLinkController';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { login } from '@/routes';
import { Form, Head, Link } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { useTranslations } from '@/composables/useTranslations';

const { __ } = useTranslations();

defineProps<{
    status?: string;
}>();
</script>

<template>
    <Head :title="__('Forgot password')">
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
                <!-- Header vacío, o puedes poner un enlace a "Login" -->
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
                            <h1 class="text-lg font-semibold">{{ __('Forgot password') }}</h1>
                            <p class="text-sm text-muted-foreground">{{ __('Enter your email to receive a password reset link') }}</p>
                        </div>

                        <!-- Status Message -->
                        <div
                            v-if="status"
                            class="mb-4 text-center text-sm font-medium text-green-600"
                        >
                            {{ status }}
                        </div>

                        <div class="space-y-6">
                            <Form
                                v-bind="PasswordResetLinkController.store.form()"
                                v-slot="{ errors, processing }"
                            >
                                <div class="grid gap-2">
                                    <Label for="email">{{ __('Email address') }}</Label>
                                    <Input
                                        id="email"
                                        type="email"
                                        name="email"
                                        autocomplete="off"
                                        autofocus
                                        :placeholder="__('email@example.com')"
                                    />
                                    <InputError :message="errors.email" />
                                </div>

                                <div class="my-6 flex items-center justify-start">
                                    <Button
                                        class="w-full"
                                        :disabled="processing"
                                        data-test="email-password-reset-link-button"
                                    >
                                        <LoaderCircle
                                            v-if="processing"
                                            class="h-4 w-4 animate-spin"
                                        />
                                        {{ __('Email password reset link') }}
                                    </Button>
                                </div>
                            </Form>

                            <div class="space-x-1 text-center text-sm text-muted-foreground">
                                <span>{{ __('Or, return to') }}</span>
                                <TextLink :href="login()">{{ __('log in') }}</TextLink>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
