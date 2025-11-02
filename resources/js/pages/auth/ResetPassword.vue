<script setup lang="ts">
import NewPasswordController from '@/actions/App/Http/Controllers/Auth/NewPasswordController';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Form, Head, Link } from '@inertiajs/vue3'; // Añadido Head y Link
import { LoaderCircle } from 'lucide-vue-next';
import { ref } from 'vue';
import { useTranslations } from '@/composables/useTranslations'; // Añadido composable

const { __ } = useTranslations();

const props = defineProps<{
    token: string;
    email: string;
}>();

const inputEmail = ref(props.email);
</script>

<template>
    <Head :title="__('Reset password')">
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
                            <h1 class="text-lg font-semibold">{{ __('Reset password') }}</h1>
                            <p class="text-sm text-muted-foreground">{{ __('Please enter your new password below') }}</p>
                        </div>

                        <!-- Formulario de Reset Password -->
                        <Form
                            v-bind="NewPasswordController.store.form()"
                            :transform="(data) => ({ ...data, token, email })"
                            :reset-on-success="['password', 'password_confirmation']"
                            v-slot="{ errors, processing }"
                        >
                            <div class="grid gap-6">
                                <div class="grid gap-2">
                                    <Label for="email">{{ __('Email') }}</Label>
                                    <Input
                                        id="email"
                                        type="email"
                                        name="email"
                                        autocomplete="email"
                                        v-model="inputEmail"
                                        class="mt-1 block w-full"
                                        readonly
                                    />
                                    <InputError :message="errors.email" class="mt-2" />
                                </div>

                                <div class="grid gap-2">
                                    <Label for="password">{{ __('Password') }}</Label>
                                    <Input
                                        id="password"
                                        type="password"
                                        name="password"
                                        autocomplete="new-password"
                                        class="mt-1 block w-full"
                                        autofocus
                                        :placeholder="__('Password')"
                                    />
                                    <InputError :message="errors.password" />
                                </div>

                                <div class="grid gap-2">
                                    <Label for="password_confirmation">
                                        {{ __('Confirm Password') }}
                                    </Label>
                                    <Input
                                        id="password_confirmation"
                                        type="password"
                                        name="password_confirmation"
                                        autocomplete="new-password"
                                        class="mt-1 block w-full"
                                        :placeholder="__('Confirm password')"
                                    />
                                    <InputError :message="errors.password_confirmation" />
                                </div>

                                <Button
                                    type="submit"
                                    class="mt-4 w-full"
                                    :disabled="processing"
                                    data-test="reset-password-button"
                                >
                                    <LoaderCircle
                                        v-if="processing"
                                        class="h-4 w-4 animate-spin"
                                    />
                                    {{ __('Reset password') }}
                                </Button>
                            </div>
                        </Form>
                    </div>
                </div>
            </main>
        </div>

        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
