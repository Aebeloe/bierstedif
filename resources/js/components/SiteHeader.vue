<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import { Facebook, Instagram, Ghost, Menu, X, ChevronDown, ChevronUp } from 'lucide-vue-next';
import { useNavigation } from '@/composables/useNavigation';
import type { NavItem } from '@/composables/useNavigation';

const navItems = useNavigation();
const openDropdown = ref<string | null>(null);
const mobileMenuOpen = ref(false);
const mobileExpanded = ref<string | null>(null);

function toggleDropdown(label: string) {
    openDropdown.value = openDropdown.value === label ? null : label;
}

function closeDropdown(e: MouseEvent) {
    if (!(e.target as HTMLElement).closest('.nav-dropdown')) {
        openDropdown.value = null;
    }
}

function toggleMobileSection(label: string) {
    mobileExpanded.value = mobileExpanded.value === label ? null : label;
}

function closeMobileMenu() {
    mobileMenuOpen.value = false;
    mobileExpanded.value = null;
}

onMounted(() => window.addEventListener('click', closeDropdown));
onUnmounted(() => window.removeEventListener('click', closeDropdown));
</script>

<template>
    <!-- Top bar -->
    <div class="bg-bif-header text-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-2">
            <div class="flex items-center gap-4">
                <a href="https://www.facebook.com/bierstedif" target="_blank" rel="noopener" class="transition hover:text-bif-accent">
                    <Facebook class="h-5 w-5" />
                </a>
                <a href="https://www.instagram.com/bierstedif/" target="_blank" rel="noopener" class="transition hover:text-bif-accent">
                    <Instagram class="h-5 w-5" />
                </a>
                <a href="https://www.snapchat.com/@bierstedif?share_id=UyrTUIG6uO8&locale=da-DK" target="_blank" rel="noopener" class="transition hover:text-bif-accent">
                    <Ghost class="h-5 w-5" />
                </a>
            </div>
            <Link href="/" class="text-xl font-bold tracking-wide transition hover:text-bif-accent">
                Biersted IF
            </Link>
        </div>
    </div>

    <!-- Desktop nav -->
    <nav class="hidden border-b border-gray-200 bg-bif-header lg:block">
        <div class="mx-auto flex max-w-6xl items-center justify-center px-4">
            <ul class="flex items-center gap-1">
                <li v-for="item in navItems" :key="item.label" class="nav-dropdown relative">
                    <!-- Items with children (dropdown) -->
                    <template v-if="item.children">
                        <button
                            @click.stop="toggleDropdown(item.label)"
                            class="flex items-center gap-1 px-4 py-4 text-xs font-medium uppercase tracking-wider text-gray-300 transition hover:text-white"
                        >
                            {{ item.label }}
                            <ChevronDown class="h-3 w-3" />
                        </button>
                        <Transition
                            enter-active-class="transition duration-150 ease-out"
                            enter-from-class="scale-95 opacity-0"
                            enter-to-class="scale-100 opacity-100"
                            leave-active-class="transition duration-100 ease-in"
                            leave-from-class="scale-100 opacity-100"
                            leave-to-class="scale-95 opacity-0"
                        >
                            <div
                                v-if="openDropdown === item.label"
                                class="absolute left-0 top-full z-50 min-w-[200px] rounded-b-lg border-t-2 border-bif-accent bg-white py-2 shadow-lg"
                            >
                                <template v-for="child in item.children" :key="child.label">
                                    <a
                                        v-if="child.external"
                                        :href="child.href"
                                        target="_blank"
                                        rel="noopener"
                                        class="block px-4 py-2 text-sm text-bif-fg transition hover:bg-bif-bg hover:text-bif-accent"
                                    >
                                        {{ child.label }}
                                    </a>
                                    <Link
                                        v-else
                                        :href="child.href"
                                        class="block px-4 py-2 text-sm text-bif-fg transition hover:bg-bif-bg hover:text-bif-accent"
                                        @click="openDropdown = null"
                                    >
                                        {{ child.label }}
                                    </Link>
                                </template>
                            </div>
                        </Transition>
                    </template>

                    <!-- Simple links -->
                    <template v-else>
                        <Link
                            :href="item.href"
                            class="block px-4 py-4 text-xs font-medium uppercase tracking-wider text-gray-300 transition hover:text-white"
                        >
                            {{ item.label }}
                        </Link>
                    </template>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Mobile hamburger button -->
    <div class="flex items-center justify-between border-b border-gray-200 bg-bif-header px-4 py-3 lg:hidden">
        <Link href="/" class="text-lg font-bold text-white">Biersted IF</Link>
        <button @click="mobileMenuOpen = true" class="text-white">
            <Menu class="h-6 w-6" />
        </button>
    </div>

    <!-- Mobile menu overlay -->
    <Teleport to="body">
        <Transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-if="mobileMenuOpen" class="fixed inset-0 z-50 flex flex-col overflow-y-auto bg-bif-header text-white">
                <div class="flex items-center justify-between px-4 py-4">
                    <Link href="/" class="text-xl font-bold" @click="closeMobileMenu">Biersted IF</Link>
                    <button @click="closeMobileMenu">
                        <X class="h-6 w-6" />
                    </button>
                </div>

                <nav class="flex-1 px-4 pb-8">
                    <ul class="space-y-1">
                        <li v-for="item in navItems" :key="item.label">
                            <!-- Items with children (accordion) -->
                            <template v-if="item.children">
                                <button
                                    @click="toggleMobileSection(item.label)"
                                    class="flex w-full items-center justify-between rounded-lg px-4 py-3 text-left text-sm font-medium uppercase tracking-wider transition hover:bg-white/10"
                                >
                                    {{ item.label }}
                                    <component :is="mobileExpanded === item.label ? ChevronUp : ChevronDown" class="h-4 w-4" />
                                </button>
                                <Transition
                                    enter-active-class="transition duration-150 ease-out"
                                    enter-from-class="max-h-0 opacity-0"
                                    enter-to-class="max-h-96 opacity-100"
                                    leave-active-class="transition duration-100 ease-in"
                                    leave-from-class="max-h-96 opacity-100"
                                    leave-to-class="max-h-0 opacity-0"
                                >
                                    <ul v-if="mobileExpanded === item.label" class="ml-4 space-y-1 overflow-hidden">
                                        <li v-for="child in item.children" :key="child.label">
                                            <a
                                                v-if="child.external"
                                                :href="child.href"
                                                target="_blank"
                                                rel="noopener"
                                                class="block rounded-lg px-4 py-2 text-sm text-gray-300 transition hover:bg-white/10 hover:text-white"
                                            >
                                                {{ child.label }}
                                            </a>
                                            <Link
                                                v-else
                                                :href="child.href"
                                                class="block rounded-lg px-4 py-2 text-sm text-gray-300 transition hover:bg-white/10 hover:text-white"
                                                @click="closeMobileMenu"
                                            >
                                                {{ child.label }}
                                            </Link>
                                        </li>
                                    </ul>
                                </Transition>
                            </template>

                            <!-- Simple links -->
                            <template v-else>
                                <Link
                                    :href="item.href"
                                    class="block rounded-lg px-4 py-3 text-sm font-medium uppercase tracking-wider transition hover:bg-white/10"
                                    @click="closeMobileMenu"
                                >
                                    {{ item.label }}
                                </Link>
                            </template>
                        </li>
                    </ul>

                    <!-- Social links in mobile menu -->
                    <div class="mt-8 flex items-center gap-6 px-4">
                        <a href="https://www.facebook.com/bierstedif" target="_blank" rel="noopener" class="transition hover:text-bif-accent">
                            <Facebook class="h-6 w-6" />
                        </a>
                        <a href="https://www.instagram.com/bierstedif/" target="_blank" rel="noopener" class="transition hover:text-bif-accent">
                            <Instagram class="h-6 w-6" />
                        </a>
                        <a href="https://www.snapchat.com/@bierstedif?share_id=UyrTUIG6uO8&locale=da-DK" target="_blank" rel="noopener" class="transition hover:text-bif-accent">
                            <Ghost class="h-6 w-6" />
                        </a>
                    </div>
                </nav>
            </div>
        </Transition>
    </Teleport>
</template>
