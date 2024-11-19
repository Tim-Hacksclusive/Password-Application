<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
    commonPasswords: {
        type: Array,
    },
});

const password = ref("");

const passwordStrengthArray = [
    {
        value: 1,
        color: "text-red-600",
        bgColor: "bg-red-600",
        text: "Erg zwak",
    },
    {
        value: 2,
        color: "text-red-400",
        bgColor: "bg-red-400",
        text: "Zwak",
    },
    {
        value: 3,
        color: "text-yellow-400",
        bgColor: "bg-yellow-400",
        text: "Gemiddeld",
    },
    {
        value: 4,
        color: "text-green-400",
        bgColor: "bg-green-400",
        text: "Sterk",
    },
    {
        value: 5,
        color: "text-green-600",
        bgColor: "bg-green-600",
        text: "Erg sterk",
    },
];

const hasUppercase = ref(false);
const hasDigit = ref(false);
const hasSpecial = ref(false);
const isCommon = ref(false);
const passwordLengthScore = ref(0);
const passwordEndScore = ref(1);

// Watches the password ref for changes.
watch(password, (newPassword) => {
    if (newPassword.length === 0) {
        passwordLengthScore.value = 0;
    }
    
    determinePasswordLength();
    setNewPasswordData();
});

// Sets the refs for the password data.
function setNewPasswordData() {
    const upper = /[A-Z]/.test(password.value);
    const digit = /[0-9]/.test(password.value);
    const special = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(
        password.value
    );
    const common = props.commonPasswords.includes(password.value);

    upper ? (hasUppercase.value = true) : (hasUppercase.value = false);
    digit ? (hasDigit.value = true) : (hasDigit.value = false);
    special ? (hasSpecial.value = true) : (hasSpecial.value = false);
    common ? (isCommon.value = true) : (isCommon.value = false);

    calculatePasswordScore();
}

// Determines the password length and returns the length score.
function determinePasswordLength() {
    const length = password.value.length;

    if (length > 0 && length < 8) {
        passwordLengthScore.value = 1;
    } else if (length >= 8 && length < 10) {
        passwordLengthScore.value = 2;
    } else if (length >= 10 && length < 12) {
        passwordLengthScore.value = 3;
    } else if (length >= 12 && length < 16) {
        passwordLengthScore.value = 4;
    } else if (length >= 16) {
        passwordLengthScore.value = 5;
    }
}

// Calculates the password score.
function calculatePasswordScore() {
    const uppercaseScore = hasUppercase.value ? 5 : 1;
    const digitScore = hasDigit.value ? 5 : 1;
    const specialScore = hasSpecial.value ? 5 : 1;
    const lengthScore = passwordLengthScore.value;
    let commonScore = 5;

    if (password.value.length === 0) {
        commonScore = isCommon.value ? 1 : 5;
        return;
    }

    const score =
        (uppercaseScore +
            digitScore +
            specialScore +
            commonScore +
            lengthScore) /
        5;

    passwordEndScore.value = Math.floor(score);
}
</script>

<template>
    <Head title="Welcome" />
    <div
        class="relative w-screen h-screen overflow-hidden bg-black select-none text-black/50"
    >
        <div
            id="grid-home"
            class="-z-10"
            style="transform: translate3d(16.8667px, 5.81333px, 0px)"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="140 0 855 855"
                class="h-auto w-full max-w-[1355px] max-h-[calc(100vh-11rem)] scale-150"
                style="color: white"
            >
                <defs>
                    <radialGradient
                        id="radial-gradient"
                        cx="0.5"
                        cy="0.5"
                        r="0.576"
                        gradientUnits="objectBoundingBox"
                    >
                        <stop
                            offset="0"
                            stop-color="currentColor"
                            stop-opacity="0.249"
                        ></stop>
                        <stop offset="1" stop-opacity="0"></stop>
                    </radialGradient>
                </defs>
                <path
                    d="M95.439,1155.874H199.126v103.687H95.439Zm106.043,0H305.17v103.687H201.483Zm106.043,0H411.213v103.687H307.526Zm106.044,0H517.256v103.687H413.57Zm106.043,0H623.3v103.687H519.613Zm106.044,0H729.344v103.687H625.657Zm106.043,0H835.387v103.687H731.7Zm106.044,0H941.43v103.687H837.743Zm106.043,0h103.687v103.687H943.787Zm106.044,0h103.687v103.687H1049.83Zm106.043,0h103.687v103.687H1155.874ZM95.439,1049.83H199.126v103.687H95.439Zm106.043,0H305.17v103.687H201.483Zm106.043,0H411.213v103.687H307.526Zm106.044,0H517.256v103.687H413.57Zm106.043,0H623.3v103.687H519.613Zm106.044,0H729.344v103.687H625.657Zm106.043,0H835.387v103.687H731.7Zm106.044,0H941.43v103.687H837.743Zm106.043,0h103.687v103.687H943.787Zm106.044,0h103.687v103.687H1049.83Zm106.043,0h103.687v103.687H1155.874ZM95.439,943.787H199.126v103.687H95.439Zm106.043,0H305.17v103.687H201.483Zm106.043,0H411.213v103.687H307.526Zm106.044,0H517.256v103.687H413.57Zm106.043,0H623.3v103.687H519.613Zm106.044,0H729.344v103.687H625.657Zm106.043,0H835.387v103.687H731.7Zm106.044,0H941.43v103.687H837.743Zm106.043,0h103.687v103.687H943.787Zm106.044,0h103.687v103.687H1049.83Zm106.043,0h103.687v103.687H1155.874ZM95.439,837.743H199.126V941.43H95.439Zm106.043,0H305.17V941.43H201.483Zm106.043,0H411.213V941.43H307.526Zm106.044,0H517.256V941.43H413.57Zm106.043,0H623.3V941.43H519.613Zm106.044,0H729.344V941.43H625.657Zm106.043,0H835.387V941.43H731.7Zm106.044,0H941.43V941.43H837.743Zm106.043,0h103.687V941.43H943.787Zm106.044,0h103.687V941.43H1049.83Zm106.043,0h103.687V941.43H1155.874ZM95.439,731.7H199.126V835.387H95.439Zm106.043,0H305.17V835.387H201.483Zm106.043,0H411.213V835.387H307.526Zm106.044,0H517.256V835.387H413.57Zm106.043,0H623.3V835.387H519.613Zm106.044,0H729.344V835.387H625.657Zm106.043,0H835.387V835.387H731.7Zm106.044,0H941.43V835.387H837.743Zm106.043,0h103.687V835.387H943.787Zm106.044,0h103.687V835.387H1049.83Zm106.043,0h103.687V835.387H1155.874ZM95.439,625.657H199.126V729.344H95.439Zm106.043,0H305.17V729.344H201.483Zm106.043,0H411.213V729.344H307.526Zm106.044,0H517.256V729.344H413.57Zm106.043,0H623.3V729.344H519.613Zm106.044,0H729.344V729.344H625.657Zm106.043,0H835.387V729.344H731.7Zm106.044,0H941.43V729.344H837.743Zm106.043,0h103.687V729.344H943.787Zm106.044,0h103.687V729.344H1049.83Zm106.043,0h103.687V729.344H1155.874ZM95.439,519.613H199.126V623.3H95.439Zm106.043,0H305.17V623.3H201.483Zm106.043,0H411.213V623.3H307.526Zm106.044,0H517.256V623.3H413.57Zm106.043,0H623.3V623.3H519.613Zm106.044,0H729.344V623.3H625.657Zm106.043,0H835.387V623.3H731.7Zm106.044,0H941.43V623.3H837.743Zm106.043,0h103.687V623.3H943.787Zm106.044,0h103.687V623.3H1049.83Zm106.043,0h103.687V623.3H1155.874ZM95.439,413.57H199.126V517.256H95.439Zm106.043,0H305.17V517.256H201.483Zm106.043,0H411.213V517.256H307.526Zm106.044,0H517.256V517.256H413.57Zm106.043,0H623.3V517.256H519.613Zm106.044,0H729.344V517.256H625.657Zm106.043,0H835.387V517.256H731.7Zm106.044,0H941.43V517.256H837.743Zm106.043,0h103.687V517.256H943.787Zm106.044,0h103.687V517.256H1049.83Zm106.043,0h103.687V517.256H1155.874ZM95.439,307.526H199.126V411.213H95.439Zm106.043,0H305.17V411.213H201.483Zm106.043,0H411.213V411.213H307.526Zm106.044,0H517.256V411.213H413.57Zm106.043,0H623.3V411.213H519.613Zm106.044,0H729.344V411.213H625.657Zm106.043,0H835.387V411.213H731.7Zm106.044,0H941.43V411.213H837.743Zm106.043,0h103.687V411.213H943.787Zm106.044,0h103.687V411.213H1049.83Zm106.043,0h103.687V411.213H1155.874ZM95.439,201.483H199.126V305.17H95.439Zm106.043,0H305.17V305.17H201.483Zm106.043,0H411.213V305.17H307.526Zm106.044,0H517.256V305.17H413.57Zm106.043,0H623.3V305.17H519.613Zm106.044,0H729.344V305.17H625.657Zm106.043,0H835.387V305.17H731.7Zm106.044,0H941.43V305.17H837.743Zm106.043,0h103.687V305.17H943.787Zm106.044,0h103.687V305.17H1049.83Zm106.043,0h103.687V305.17H1155.874ZM95.439,95.439H199.126V199.126H95.439Zm106.043,0H305.17V199.126H201.483Zm106.043,0H411.213V199.126H307.526Zm106.044,0H517.256V199.126H413.57Zm106.043,0H623.3V199.126H519.613Zm106.044,0H729.344V199.126H625.657Zm106.043,0H835.387V199.126H731.7Zm106.044,0H941.43V199.126H837.743Zm106.043,0h103.687V199.126H943.787Zm106.044,0h103.687V199.126H1049.83Zm106.043,0h103.687V199.126H1155.874ZM1259.561,0V93.083H1155.874V0h-2.357V93.083H1049.83V0h-2.357V93.083H943.787V0H941.43V93.083H837.743V0h-2.357V93.083H731.7V0h-2.356V93.083H625.657V0H623.3V93.083H519.613V0h-2.357V93.083H413.57V0h-2.357V93.083H307.526V0H305.17V93.083H201.483V0h-2.357V93.083H95.439V0H93.083V93.083H0v2.357H93.083V199.126H0v2.357H93.083V305.17H0v2.357H93.083V411.213H0v2.357H93.083V517.256H0v2.357H93.083V623.3H0v2.357H93.083V729.344H0V731.7H93.083V835.387H0v2.357H93.083V941.43H0v2.357H93.083v103.687H0v2.357H93.083v103.687H0v2.357H93.083v103.687H0v2.357H93.083V1355h2.357v-93.083H199.126V1355h2.357v-93.083H305.17V1355h2.357v-93.083H411.213V1355h2.357v-93.083H517.256V1355h2.357v-93.083H623.3V1355h2.357v-93.083H729.344V1355H731.7v-93.083H835.387V1355h2.357v-93.083H941.43V1355h2.357v-93.083h103.687V1355h2.357v-93.083h103.687V1355h2.357v-93.083h103.687V1355h2.357v-93.083H1355v-2.357h-93.083V1155.874H1355v-2.357h-93.083V1049.83H1355v-2.357h-93.083V943.787H1355V941.43h-93.083V837.743H1355v-2.357h-93.083V731.7H1355v-2.356h-93.083V625.657H1355V623.3h-93.083V519.613H1355v-2.357h-93.083V413.57H1355v-2.357h-93.083V307.526H1355V305.17h-93.083V201.483H1355v-2.357h-93.083V95.439H1355V93.083h-93.083V0Z"
                    fill="url(#radial-gradient)"
                ></path>
            </svg>
        </div>
        <div
            id="checker"
            class="absolute transform -translate-x-1/2 -translate-y-1/2 sm:max-w-md top-1/2 left-1/2"
        >
            <div
                class="z-50 p-8 border-2 border-white rounded-lg"
                style="background-color: #181818"
            >
                <div>
                    <h1 class="text-4xl text-center text-white font-primary">
                        Wachtwoord check
                    </h1>
                    <p class="mt-2 font-sans text-center text-white">
                        Vul hier jouw wachtwoord in en kom erachter of het
                        veilig is!
                    </p>
                </div>
                <div class="mt-8">
                    <InputLabel class="text-white">Jouw wachtwoord:</InputLabel>
                    <TextInput
                        type="password"
                        placeholder="Wachtwoord"
                        class="w-full mt-2"
                        @changeModel="password = $event"
                    />
                </div>
                <div>
                    <p class="pt-1 text-2xl text-white mt-7 font-primary">
                        Eisen voor wachtwoord:
                    </p>
                    <div class="flex flex-col mt-2 text-white gap-y-2">
                        <span class="text-gray-200">Lengte:</span>
                        <div class="w-full h-1.5 bg-gray-200 rounded-md">
                            <div
                                v-if="passwordLengthScore > 0"
                                class="h-1.5 rounded-md"
                                :class="
                                    passwordStrengthArray[
                                        passwordLengthScore - 1
                                    ].bgColor
                                "
                                :style="{
                                    width: passwordLengthScore * 20 + '%',
                                }"
                            ></div>
                            <div
                                v-if="passwordLengthScore === 0"
                                class="h-1.5 bg-red-400 rounded-md w-[0%]"
                            ></div>
                        </div>
                    </div>
                    <p class="mt-3 mb-2 text-gray-200">Overige eisen:</p>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <div class="flex items-center text-white gap-x-2">
                                <svg
                                    v-if="!hasUppercase"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    viewBox="0 -960 960 960"
                                    :class="
                                        hasUppercase
                                            ? 'fill-green-400'
                                            : 'fill-red-400'
                                    "
                                >
                                    <path
                                        d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"
                                    />
                                </svg>
                                <svg
                                    v-if="hasUppercase"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    :class="
                                        hasUppercase
                                            ? 'fill-green-400'
                                            : 'fill-red-400'
                                    "
                                    viewBox="0 -960 960 960"
                                >
                                    <path
                                        d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"
                                    />
                                </svg>
                                <span
                                    class="text-sm"
                                    :class="
                                        hasUppercase
                                            ? 'text-green-400'
                                            : 'text-red-400'
                                    "
                                >
                                    bevat een hoofdletter
                                </span>
                            </div>
                            <div class="flex mt-2 text-white gap-x-2">
                                <svg
                                    v-if="!hasSpecial"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    viewBox="0 -960 960 960"
                                    :class="
                                        hasSpecial
                                            ? 'fill-green-400'
                                            : 'fill-red-400'
                                    "
                                >
                                    <path
                                        d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"
                                    />
                                </svg>
                                <svg
                                    v-if="hasSpecial"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    :class="
                                        hasSpecial
                                            ? 'fill-green-400'
                                            : 'fill-red-400'
                                    "
                                    viewBox="0 -960 960 960"
                                >
                                    <path
                                        d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"
                                    />
                                </svg>
                                <span
                                    class="text-sm"
                                    :class="
                                        hasSpecial
                                            ? 'text-green-400'
                                            : 'text-red-400'
                                    "
                                >
                                    bevat een speciaal teken
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div
                                class="flex items-center text-white gap-x-2"
                            >
                                <svg
                                    v-if="!hasDigit"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    viewBox="0 -960 960 960"
                                    :class="
                                        hasDigit
                                            ? 'fill-green-400'
                                            : 'fill-red-400'
                                    "
                                >
                                    <path
                                        d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"
                                    />
                                </svg>
                                <svg
                                    v-if="hasDigit"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    :class="
                                        hasDigit
                                            ? 'fill-green-400'
                                            : 'fill-red-400'
                                    "
                                    viewBox="0 -960 960 960"
                                >
                                    <path
                                        d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"
                                    />
                                </svg>
                                <span
                                    class="text-sm"
                                    :class="
                                        hasDigit
                                            ? 'text-green-400'
                                            : 'text-red-400'
                                    "
                                >
                                    bevat een getal
                                </span>
                            </div>
                            <div
                                class="flex items-center mt-2 text-white gap-x-2"
                            >
                                <svg
                                    v-if="isCommon"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    viewBox="0 -960 960 960"
                                    :class="
                                        isCommon
                                            ? 'fill-red-400'
                                            : 'fill-green-400'
                                    "
                                >
                                    <path
                                        d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"
                                    />
                                </svg>
                                <svg
                                    v-if="!isCommon"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    :class="
                                        isCommon
                                            ? 'fill-red-400'
                                            : 'fill-green-400'
                                    "
                                    viewBox="0 -960 960 960"
                                >
                                    <path
                                        d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"
                                    />
                                </svg>
                                <span
                                    class="text-sm"
                                    :class="
                                        isCommon
                                            ? 'text-red-400'
                                            : 'text-green-400'
                                    "
                                >
                                    {{
                                        isCommon
                                            ? "veel voorkomend"
                                            : "niet veel voorkomend"
                                    }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-center py-2.5 mt-10 text-black bg-gray-500 rounded-md gap-x-2"
                    >
                        <p class="text-xl font-medium text-white">Eindscore:</p>
                        <span
                            v-if="password && password.length > 0"
                            class="flex items-center justify-center text-xl font-medium text-white rounded-full h-7 w-7"
                            :class="
                                passwordStrengthArray[passwordEndScore - 1]
                                    .bgColor
                            "
                            >{{ passwordEndScore }}</span
                        >
                        <span
                            v-if="!password && password.length === 0"
                            class="flex items-center justify-center text-xl font-medium text-white bg-red-600 rounded-full w-7 h-7"
                            >1</span
                        >
                    </div>
                </div>
                <div class="flex justify-center mt-7">
                    <img
                        src="../../img/hacksclusive-logo.png"
                        class="w-32"
                        alt="hacksclusive-logo"
                    />
                </div>
            </div>
        </div>
    </div>
</template>