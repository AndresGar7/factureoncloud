<script setup lang="ts">
import AuthenticatedSessionController from '@/actions/App/Http/Controllers/Auth/AuthenticatedSessionController';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { dashboard, login, register } from '@/routes';
import { request } from '@/routes/password';
import { Form, Head, Link } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { useTranslations } from '@/composables/useTranslations';

const { __ } = useTranslations();

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();
</script>

<template>
    <Head :title="__('Log in')">
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
                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class="inline-block rounded-sm border border-[var(--border)] px-5 py-1.5 text-sm leading-normal text-[var(--foreground)] hover:text-[var(--primary)] hover:border-[var(--primary)] transition-colors"
                >
                    Dashboard
                </Link>
            </nav>
        </header>

        <div
            class="flex w-full items-center justify-center opacity-100 transition-opacity duration-700 lg:grow starting:opacity-0"
        >
            <main
                class="w-full max-w-[335px] overflow-hidden rounded-2xl lg:max-w-lg shadow-[0_8px_30px_rgba(0,0,0,0.08)] bg-[var(--card)] text-[var(--card-foreground)] transition-colors duration-500"
            >
                <!-- Columna Izquierda (Formulario) -->
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

                        <!-- Status Message -->
                        <div
                            v-if="status"
                            class="mb-4 text-center text-sm font-medium text-green-600"
                        >
                            {{ status }}
                        </div>

                        <!-- Formulario de Login -->
                        <Form
                            v-bind="AuthenticatedSessionController.store.form()"
                            :reset-on-success="['password']"
                            v-slot="{ errors, processing }"
                            class="flex flex-col gap-6"
                        >
                            <div class="grid gap-6">
                                <div class="grid gap-2">
                                    <Label for="email">{{ __('Email address') }}</Label>
                                    <Input
                                        id="email"
                                        type="email"
                                        name="email"
                                        required
                                        autofocus
                                        :tabindex="1"
                                        autocomplete="email"
                                        :placeholder="__('email@example.com')"
                                    />
                                    <InputError :message="errors.email" />
                                </div>

                                <div class="grid gap-2">
                                    <div class="flex items-center justify-between">
                                        <Label for="password">{{ __('Password') }}</Label>
                                        <TextLink
                                            v-if="canResetPassword"
                                            :href="request()"
                                            class="text-sm"
                                            :tabindex="5"
                                        >
                                            {{ __('Forgot password?') }}
                                        </TextLink>
                                    </div>
                                    <Input
                                        id="password"
                                        type="password"
                                        name="password"
                                        required
                                        :tabindex="2"
                                        autocomplete="current-password"
                                        :placeholder="__('Password')"
                                    />
                                    <InputError :message="errors.password" />
                                </div>

                                <div class="flex items-center justify-between">
                                    <Label for="remember" class="flex items-center space-x-3">
                                        <Checkbox id="remember" name="remember" :tabindex="3" />
                                        <span>{{ __('Remember me') }}</span>
                                    </Label>
                                </div>

                                <Button
                                    type="submit"
                                    class="mt-4 w-full"
                                    :tabindex="4"
                                    :disabled="processing"
                                    data-test="login-button"
                                >
                                    <LoaderCircle
                                        v-if="processing"
                                        class="h-4 w-4 animate-spin"
                                    />
                                    {{ __('Log in') }}
                                </Button>
                            </div>

                            <div class="text-center text-sm text-muted-foreground">
                                {{ __("Don't have an account?") }}
                                <TextLink :href="register()" :tabindex="5">{{ __('Sign up') }}</TextLink>
                            </div>
                        </Form>
                    </div>
                </div>
            </main>
        </div>

        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>

