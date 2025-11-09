<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Settings, LayoutGrid } from 'lucide-vue-next';
import { useSidebar } from '@/components/ui/sidebar/utils';
import AppLogo from './AppLogo.vue';
// Importar el composable de traducciones
import { useTranslations } from '@/composables/useTranslations';
const { __ } = useTranslations();
const { state } = useSidebar();

const mainNavItems = [
    {
        title: __('Dashboard'),
        href: dashboard(),
        icon: LayoutGrid,
        items: [
        {
            title: "History",
            url: "#",
        },
        {
            title: "Starred",
            url: "#",
        },
        {
            title: "Settings",
            url: "#",
        },
        ],
    },
    {
        title: __('Dashboard2'),
        href: dashboard(),
        icon: LayoutGrid,
        
    },
];

const footerNavItems: NavItem[] = [
    {
        title: __('Settings'),
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: Settings,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo v-if="state !== 'collapsed'" />
                            <img 
                                v-else 
                                src="/img/iconfacture.png" 
                                alt="Logo Colapsado" 
                                class="h-6 w-6" 
                            />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>