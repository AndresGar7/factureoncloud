<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import {
    PinInput,
    PinInputGroup,
    PinInputSlot,
} from '@/components/ui/pin-input';
import { store } from '@/routes/two-factor/login';
import { Form, Head, Link } from '@inertiajs/vue3'; // Añadido Head y Link
import { computed, ref } from 'vue';
import { useTranslations } from '@/composables/useTranslations'; // Añadido composable

const { __ } = useTranslations();

interface AuthConfigContent {
    title: string;
    description: string;
    toggleText: string;
}

const authConfigContent = computed<AuthConfigContent>(() => {
    if (showRecoveryInput.value) {
        return {
            title: __('Recovery Code'),
            description:
                __('Please confirm access to your account by entering one of your emergency recovery codes.'),
            toggleText: __('login using an authentication code'),
        };
    }

    return {
        title: __('Authentication Code'),
        description:
            __('Enter the authentication code provided by your authenticator application.'),
        toggleText: __('login using a recovery code'),
    };
});

const showRecoveryInput = ref<boolean>(false);

const toggleRecoveryMode = (clearErrors: () => void): void => {
    showRecoveryInput.value = !showRecoveryInput.value;
    clearErrors();
    code.value = [];
};

const code = ref<number[]>([]);
const codeValue = computed<string>(() => code.value.join(''));
</script>

<template>
    <Head :title="__('Two-Factor Authentication')">
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

                        <!-- Título y Descripción Dinámicos -->
                        <div class="text-center mb-6">
                            <h1 class="text-lg font-semibold">{{ authConfigContent.title }}</h1>
                            <p class="text-sm text-muted-foreground">{{ authConfigContent.description }}</p>
                        </div>

                        <!-- Formularios -->
                        <div class="space-y-6">
                            <template v-if="!showRecoveryInput">
                                <Form
                                    v-bind="store.form()"
                                    class="space-y-4"
                                    reset-on-error
                                    @error="code = []"
                                    #default="{ errors, processing, clearErrors }"
                                >
                                    <input type="hidden" name="code" :value="codeValue" />
                                    <div
                                        class="flex flex-col items-center justify-center space-y-3 text-center"
                                    >
                                        <div class="flex w-full items-center justify-center">
                                            <PinInput
                                                id="otp"
                                                placeholder="○"
                                                v-model="code"
                                                type="number"
                                                otp
                                            >
                                                <PinInputGroup>
                                                    <PinInputSlot
                                                        v-for="(id, index) in 6"
                                                        :key="id"
                                                        :index="index"
                                                        :disabled="processing"
                                                        autofocus
                                                    />
                                                </PinInputGroup>
                                            </PinInput>
                                        </div>
                                        <InputError :message="errors.code" />
                                    </div>
                                    <Button type="submit" class="w-full" :disabled="processing">
                                        {{ __('Continue') }}
                                    </Button>
                                    <div class="text-center text-sm text-muted-foreground">
                                        <span>{{ __('or you can ') }}</span>
                                        <button
                                            type="button"
                                            class="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
                                            @click="() => toggleRecoveryMode(clearErrors)"
                                        >
                                            {{ authConfigContent.toggleText }}
                                        </button>
                                    </div>
                                </Form>
                            </template>

                            <template v-else>
                                <Form
                                    v-bind="store.form()"
                                    class="space-y-4"
                                    reset-on-error
                                    #default="{ errors, processing, clearErrors }"
                                >
                                    <Input
                                        name="recovery_code"
                                        type="text"
                                        :placeholder="__('Enter recovery code')"
                                        :autofocus="showRecoveryInput"
                                        required
                                    />
                                    <InputError :message="errors.recovery_code" />
                                    <Button type="submit" class="w-full" :disabled="processing">
                                        {{ __('Continue') }}
                                    </Button>

                                    <div class="text-center text-sm text-muted-foreground">
                                        <span>{{ __('or you can ') }}</span>
                                        <button
                                            type="button"
                                            class="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
                                            @click="() => toggleRecoveryMode(clearErrors)"
                                        >
                                            {{ authConfigContent.toggleText }}
                                        </button>
                                    </div>
                                </Form>
                            </template>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
