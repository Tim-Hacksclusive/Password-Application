<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
    <Head title="Welcome" />
    <div class="relative w-screen h-screen bg-black text-black/50">
        <div
            class="absolute grid grid-cols-6 transform -translate-x-1/2 -translate-y-1/2 shadow-inner-lg shadow-gray-400 top-1/2 left-1/2"
        >
            <div
                v-for="i in 30"
                :key="i"
                class="h-16 w-16 sm:w-32 sm:h-32 border-[0.5px] border-zinc-600"
            ></div>
            <div
                class="absolute p-8 transform -translate-x-1/2 -translate-y-1/2 bg-gray-200 top-1/2 left-1/2"
            >
                <div>
                    <h1 class="text-4xl">Wachtwoord check</h1>
                    <p>
                        Vul hier je wachtwoord in en kom erachter of het veilig
                        is!
                    </p>
                </div>
            </div>
            <div class="absolute">
                <svg
                    version="1.0"
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-12 h-12 fill-white"
                    viewBox="0 0 24  707.000000"
                    preserveAspectRatio="xMidYMid meet"
                >
                    <g
                        transform="translate(0.000000,707.000000) scale(0.100000,-0.100000)"
                        fill="white"
                        stroke="none"
                    ></g>
                </svg>
            </div>
        </div>
    </div>
</template>
