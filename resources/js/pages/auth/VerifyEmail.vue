<script setup lang="ts">
import EmailVerificationNotificationController from '@/actions/App/Http/Controllers/Auth/EmailVerificationNotificationController';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { logout } from '@/routes';
import { Form, Head, Link } from '@inertiajs/vue3'; // Añadido Head y Link
import { LoaderCircle } from 'lucide-vue-next';
import { useTranslations } from '@/composables/useTranslations'; // Añadido composable

const { __ } = useTranslations();

defineProps<{
    status?: string;
}>();
</script>

<template>
    <Head :title="__('Email verification')">
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
                            <h1 class="text-lg font-semibold">{{ __('Verify email') }}</h1>
                            <p class="text-sm text-muted-foreground">{{ __('Please verify your email address by clicking on the link we just emailed to you.') }}</p>
                        </div>

                        <!-- Mensaje de Estado -->
                        <div
                            v-if="status === 'verification-link-sent'"
                            class="mb-4 text-center text-sm font-medium text-green-600"
                        >
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>

                        <!-- Formulario de Reenviar -->
                        <Form
                            v-bind="EmailVerificationNotificationController.store.form()"
                            class="space-y-6 text-center"
                            v-slot="{ processing }"
                        >
                            <Button :disabled="processing" variant="secondary" class="w-full">
                                <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin" />
                                {{ __('Resend verification email') }}
                            </Button>

                            <TextLink
                                :href="logout()"
                                as="button"
                                class="mx-auto block text-sm"
                            >
                                {{ __('Log out') }}
                            </TextLink>
                        </Form>
                    </div>
                </div>
            </main>
        </div>

        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
