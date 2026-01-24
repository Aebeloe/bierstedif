<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref } from 'vue';

const props = defineProps<{
    menuData: Record<string, Array<{ label: string; url: string }>>;
}>();

const navItems = [
    { label: 'Udvalg', href: '#', hasDropdown: true },
    { label: 'Tilmeldinger', href: '#', hasDropdown: false },
    { label: 'Om Foreningen', href: '#', hasDropdown: true },
    { label: 'Kalender', href: '#', hasDropdown: false },
    { label: 'Kontakt', href: '#', hasDropdown: false },
    { label: 'Klubdragt', href: '#', hasDropdown: false },
    { label: 'Sponsorer', href: '#', hasDropdown: false },
];

const openDropdown = ref<string | null>(null);

const toggleDropdown = (label: string) => {
    openDropdown.value = openDropdown.value === label ? null : label;
};

const closeDropdown = (e: MouseEvent) => {
    const target = e.target as HTMLElement;
    if (!target.closest('.nav-item-container')) {
        openDropdown.value = null;
    }
};

onMounted(() => window.addEventListener('click', closeDropdown));
onUnmounted(() => window.removeEventListener('click', closeDropdown));
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <div
        class="flex min-h-screen flex-col items-center bg-[#FDFDFC] text-[#1b1b18] dark:bg-[#0a0a0a]"
    >
        <header class="w-full">
            <div
                class="flex items-center justify-center bg-[#1a1a1a] px-4 py-2 text-white"
            >
                <div
                    class="flex w-full max-w-7xl flex-col items-center justify-center gap-4 text-sm font-medium md:flex-row md:gap-6"
                >
                    <div
                        class="flex items-center gap-4 md:border-r md:border-gray-600 md:pr-6"
                    >
                        <a href="#" class="hover:text-gray-300"
                            ><i class="fab fa-facebook-f text-lg"></i
                        ></a>
                        <a href="#" class="hover:text-gray-300"
                            ><i class="fab fa-instagram text-lg"></i
                        ></a>
                        <a href="#" class="hover:text-gray-300"
                            ><i class="fab fa-snapchat-ghost text-lg"></i
                        ></a>
                    </div>

                    <nav class="flex flex-wrap justify-center gap-x-6 gap-y-2">
                        <div
                            v-for="item in navItems"
                            :key="item.label"
                            class="nav-item-container relative"
                        >
                            <button
                                v-if="item.hasDropdown"
                                @click.stop="toggleDropdown(item.label)"
                                class="flex items-center gap-1 py-2 text-xs tracking-wider uppercase transition-colors hover:text-gray-300"
                            >
                                {{ item.label }}
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    :class="{
                                        'rotate-180':
                                            openDropdown === item.label,
                                    }"
                                    class="h-3 w-3 transition-transform"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 9l-7 7-7-7"
                                    />
                                </svg>
                            </button>

                            <Link
                                v-else
                                :href="item.href"
                                class="block py-2 text-xs tracking-wider uppercase transition-colors hover:text-gray-300"
                            >
                                {{ item.label }}
                            </Link>

                            <transition
                                enter-active-class="transition duration-100 ease-out"
                                enter-from-class="transform scale-95 opacity-0"
                                enter-to-class="transform scale-100 opacity-100"
                                leave-active-class="transition duration-75 ease-in"
                                leave-from-class="transform scale-100 opacity-100"
                                leave-to-class="transform scale-95 opacity-0"
                            >
                                <div
                                    v-if="
                                        item.hasDropdown &&
                                        openDropdown === item.label
                                    "
                                    class="absolute left-1/2 z-[110] mt-0 w-48 -translate-x-1/2 rounded-b-md border-t-2 border-red-600 bg-white py-2 shadow-xl"
                                >
                                    <Link
                                        v-for="subItem in props.menuData[
                                            item.label
                                        ]"
                                        :key="subItem.label"
                                        :href="subItem.url"
                                        class="block px-4 py-2 text-center text-sm text-gray-800 transition-colors hover:bg-gray-100 hover:text-red-600"
                                    >
                                        {{ subItem.label }}
                                    </Link>
                                </div>
                            </transition>
                        </div>
                    </nav>
                </div>
            </div>

            <div
                class="relative flex h-[200px] w-full items-center justify-center overflow-hidden bg-gray-200 lg:h-[250px]"
            >
                <img
                    src="/cover.png"
                    alt="Football Field"
                    class="absolute inset-0 h-full w-full object-cover brightness-75"
                />
            </div>
        </header>

        <main class="flex w-full flex-col items-center px-6 py-12">
            <footer
                class="w-full max-w-5xl overflow-hidden rounded-xl bg-gray-100 shadow-lg"
            >
                <div
                    class="relative flex flex-col items-center p-8 text-center"
                >

                    <div class="z-10 mb-6">
                        <img
                            src="/velkomstvaert.jpeg"
                            alt="Henrik Leding Skøtt"
                            class="h-40 w-40 rounded-full border-4 border-white object-cover shadow-md"
                        />
                    </div>

                    <div class="z-10 flex flex-col items-center">
                        <h3 class="mb-2 text-2xl font-bold text-gray-800">
                            Velkomstvært
                        </h3>
                        <p
                            class="mb-6 max-w-2xl text-sm leading-relaxed text-gray-700"
                        >
                            Er du ny i foreningen, vil du gerne vide mere om
                            bestemte hold, eller vil du deltage i fællesskabet
                            som frivillig? Så kontakt BIFs velkomstvært. Henrik
                            kan svare på det meste og hvis ikke, så kender han
                            nogle, der kan.
                        </p>

                        <div class="mb-8 text-sm font-medium text-gray-900">
                            <p class="text-lg">Henrik Leding Skøtt</p>
                            <p>
                                Tel. 61279081 &bull; Mail:
                                <a
                                    href="mailto:formand@bierstedif.dk"
                                    class="underline hover:text-blue-700"
                                    >formand@bierstedif.dk</a
                                >
                            </p>
                        </div>

                        <a
                            href="#"
                            class="inline-block rounded-full bg-[#0078d4] px-10 py-4 text-center font-bold text-white transition-all hover:bg-[#005a9e] hover:shadow-lg"
                        >
                            Klik her – for at deltage i en gratis prøvetræning
                        </a>
                    </div>
                </div>
            </footer>
        </main>
    </div>
</template>
