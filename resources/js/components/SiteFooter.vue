<script setup lang="ts">
import { Mail, Phone, MapPin } from 'lucide-vue-next';
</script>

<template>
    <footer class="bg-bif-header text-gray-300">
        <div class="mx-auto max-w-6xl px-4 py-10">
            <div class="grid gap-8 md:grid-cols-3">
                <!-- Address -->
                <div class="flex items-start gap-3">
                    <MapPin class="mt-1 h-5 w-5 shrink-0 text-bif-accent" />
                    <div>
                        <p class="font-medium text-white">Biersted IF</p>
                        <p>Bierstedhallen</p>
                        <p>Idrætsvej 15B</p>
                        <p>Biersted, 9440</p>
                    </div>
                </div>

                <!-- Contact -->
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <Phone class="h-5 w-5 shrink-0 text-bif-accent" />
                        <a href="tel:61279081" class="transition hover:text-white">61 27 90 81</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <Mail class="h-5 w-5 shrink-0 text-bif-accent" />
                        <a href="mailto:bierstedif@bierstedif.dk" class="transition hover:text-white">bierstedif@bierstedif.dk</a>
                    </div>
                </div>

                <!-- Legal -->
                <div class="space-y-1 text-sm">
                    <p><span class="text-gray-400">CVR:</span> 27682618</p>
                    <p><span class="text-gray-400">P-nummer:</span> 1001617675</p>
                    <p><span class="text-gray-400">Bank:</span> 7447 2002109</p>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-700 pt-6 text-center text-sm text-gray-400">
                &copy; {{ new Date().getFullYear() }} Biersted IF. Alle rettigheder forbeholdes.
            </div>
        </div>
    </footer>
</template>
