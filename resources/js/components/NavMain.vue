<script setup lang="ts">
import type { LucideIcon } from "lucide-vue-next"
import { ChevronRight } from "lucide-vue-next"
import {
    Collapsible,
    CollapsibleContent,
    CollapsibleTrigger,
} from "@/components/ui/collapsible"
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarMenuSub,
    SidebarMenuSubButton,
    SidebarMenuSubItem,
} from '@/components/ui/sidebar';
import { urlIsActive } from '@/lib/utils';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
// Importar el composable de traducciones
import { useTranslations } from '@/composables/useTranslations';
const { __ } = useTranslations();

defineProps<{
    items: NavItem[];
}>();

const page = usePage();

// --- INICIO DE MODIFICACIÓN 1: Función de ayuda ---
// Pequeña función para comprobar si el item tiene hijos
function hasChildren(item: NavItem): boolean {
    return Array.isArray(item.items) && item.items.length > 0;
}
// --- FIN DE MODIFICACIÓN 1 ---
</script>

<template>
    <SidebarGroup>
        <SidebarGroupLabel>{{ __('Platform') }}</SidebarGroupLabel>
        <SidebarMenu>
            <!-- 
              --- INICIO DE MODIFICACIÓN 2: Usar <template> para el v-for ---
              Esto nos permite usar v-if y v-else dentro del bucle
            -->
            <template v-for="item in items" :key="item.title">
                
                <!-- 
                  CASO 1: El item TIENE hijos (es un desplegable)
                  Usamos la lógica de <Collapsible> que ya tenías.
                -->
                <Collapsible
                    v-if="hasChildren(item)"
                    as-child
                    :default-open="item.isActive"
                    class="group/collapsible"
                >
                    <SidebarMenuItem>
                        <CollapsibleTrigger as-child>
                            <SidebarMenuButton :tooltip="item.title">
                                <component :is="item.icon" v-if="item.icon" />
                                <span>{{ item.title }}</span>
                                <ChevronRight class="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                            </SidebarMenuButton>
                        </CollapsibleTrigger>
                        <CollapsibleContent>
                            <SidebarMenuSub>
                                <SidebarMenuSubItem v-for="subItem in item.items" :key="subItem.title">
                                    <SidebarMenuSubButton as-child>
                                        <a :href="subItem.url">
                                            <span>{{ subItem.title }}</span>
                                        </a>
                                    </SidebarMenuSubButton>
                                </SidebarMenuSubItem>
                            </SidebarMenuSub>
                        </CollapsibleContent>
                    </SidebarMenuItem>
                </Collapsible>

                <!-- 
                  CASO 2: El item NO tiene hijos (es un enlace simple)
                  Renderizamos un <SidebarMenuItem> con un <Link> directo.
                -->
                <SidebarMenuItem v-else>
                    <SidebarMenuButton
                        as-child
                        :tooltip="item.title"
                        :variant="urlIsActive(item.href, page.url) ? 'secondary' : 'default'"
                    >
                        <!-- Usamos <Link> de Inertia para el enlace principal -->
                        <Link :href="item.href">
                            <component :is="item.icon" v-if="item.icon" />
                            <span>{{ item.title }}</span>
                            <!-- Fíjate que aquí NO hay <ChevronRight> -->
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
                
            </template>
            <!-- --- FIN DE MODIFICACIÓN 2 --- -->

        </SidebarMenu>
    </SidebarGroup>
</template>