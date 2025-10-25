<script setup lang="ts">
import { dashboard, login, register } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <!-- Fondo general -->
    <div
        class="flex min-h-screen flex-col items-center bg-[var(--background)] text-[var(--foreground)] p-6 lg:justify-center lg:p-8 transition-colors duration-500"
    >
        <!-- Header -->
        <header
            class="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl"
        >
            <nav class="flex items-center justify-end gap-4">
                <!-- Solo Dashboard si el usuario está logueado -->
                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class="inline-block rounded-sm border border-[var(--border)] px-5 py-1.5 text-sm leading-normal text-[var(--foreground)] hover:text-[var(--primary)] hover:border-[var(--primary)] transition-colors"
                >
                    Dashboard
                </Link>
            </nav>
        </header>

        <!-- Contenido principal -->
        <div
            class="flex w-full items-center justify-center opacity-100 transition-opacity duration-700 lg:grow starting:opacity-0"
        >
            <main
                class="flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-2xl lg:max-w-5xl lg:flex-row shadow-[0_8px_30px_rgba(0,0,0,0.08)] bg-[var(--card)] text-[var(--card-foreground)] transition-colors duration-500"
            >
                <!-- Texto y botones -->
                <div
                    class="flex-1 rounded-br-2xl rounded-bl-2xl p-8 text-[14px] leading-relaxed lg:rounded-tl-2xl lg:rounded-br-none lg:p-16 flex flex-col justify-center"
                >
                    <h1 class="mb-4 font-semibold text-[var(--primary)] text-lg">
                        Lleva la contabilidad de tu empresa de forma sencilla y automatizada.
                    </h1>
                    <p class="mb-6 text-[var(--muted-foreground)]">
                        Registra tus facturas, gastos y compras en pocos pasos, y genera tus libros contables actualizados en todo momento.
                        <br />
                        Completa tu contabilidad con asientos manuales y accede a toda tu información desde cualquier lugar. 
                    </p>

                    <!-- Botones: Login, Register, Blog -->
                    <ul class="flex flex-col gap-3 mt-6">
                        <!-- Login -->
                        <li>
                            <Link
                                :href="login()"
                                class="w-full inline-block rounded-md bg-[var(--primary)] text-[var(--primary-foreground)] px-6 py-2 text-center font-medium hover:bg-[var(--ring)] transition-colors"
                            >
                                Iniciar sesión
                            </Link>
                        </li>

                        <!-- Register -->
                        <li>
                            <Link
                                :href="register()"
                                class="w-full inline-block rounded-md bg-[var(--secondary)] text-[var(--secondary-foreground)] px-6 py-2 text-center font-medium hover:bg-[var(--ring)] transition-colors"
                            >
                                Crear Cuenta
                            </Link>
                        </li>

                        <!-- Blog -->
                        <li>
                            <a
                                href="/blog"
                                class="w-full inline-block rounded-md bg-[var(--accent)] text-[var(--accent-foreground)] px-6 py-2 text-center font-medium hover:bg-[var(--ring)] transition-colors"
                            >
                                FacureOnCloud
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Imagen -->
                <div
                    class="relative w-full lg:w-[450px] bg-[var(--secondary)] flex items-center justify-center overflow-hidden rounded-t-2xl lg:rounded-t-none lg:rounded-r-2xl"
                >
                    <img
                        src="/img/sessionstart.jpg"
                        alt="Contabilidad automatizada"
                        class="object-cover object-center w-full h-full max-h-[400px] lg:max-h-none lg:h-full rounded-t-2xl lg:rounded-t-none lg:rounded-r-2xl"
                    />
                    <div
                        class="absolute inset-0 bg-[var(--primary)]/10 mix-blend-overlay"
                    ></div>
                </div>
            </main>
        </div>

        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
