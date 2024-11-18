<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head } from "@inertiajs/vue3";
import { computed, ref, watch } from "vue";

const props = defineProps({
    commonPasswords: {
        type: Array,
    },
});

const password = defineModel({
    required: true,
});

const passwordLengthLayout = ref({
    color: "text-red-400",
    value: 1,
    text: "Erg kort",
});

const passwordStrengthArray = [
    {
        value: 1,
        color: "red-400",
        text: "Erg zwak",
    },
    {
        value: 2,
        color: "red-200",
        text: "Zwak",
    },
    {
        value: 3,
        color: "yellow-400",
        text: "Gemiddeld",
    },
    {
        value: 4,
        color: "green-200",
        text: "Sterk",
    },
    {
        value: 5,
        color: "green-400",
        text: "Erg sterk",
    },
];

const hasUppercase = ref(false);
const hasDigit = ref(false);
const hasSpecial = ref(false);
const isCommon = ref(false);
const passwordLengthScore = ref(0);
const passwordEndScore = ref(1);

watch(password, (newPassword) => {
    if (newPassword.length === 0) {
        passwordLengthScore.value = 0;
    }
    
    determinePasswordLength();
    setNewPasswordData();
});

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

    calculatePasswordStrength();
}

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

function calculatePasswordStrength() {
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
    passwordEndScore.value = score;
}
</script>

<template>
    <Head title="Welcome" />
    <div class="relative w-screen h-screen bg-black text-black/50">
        <div>
            <div
                class="absolute p-8 transform -translate-x-1/2 -translate-y-1/2 rounded-lg lg top-1/2 left-1/2"
            >
                <img
                    src="../../img/test.png"
                    width="800px"
                    height="400px"
                    alt="background"
                />
            </div>
            <div
                class="absolute p-8 transform -translate-x-1/2 -translate-y-1/2 bg-black border-2 border-white rounded-lg lg top-1/2 left-1/2"
                style="box-shadow: 0 4px 35px rgba(255, 255, 255, 2.5)"
            >
                <div>
                    <h1 class="text-4xl text-center text-white font-primary">
                        Wachtwoord check
                    </h1>
                    <p class="mt-2 font-sans text-white">
                        Vul hier je wachtwoord in en kom erachter of het veilig
                        is!
                    </p>
                </div>
                <div class="my-10">
                    <InputLabel class="text-white">Je wachtwoord:</InputLabel>
                    <TextInput
                        type="password"
                        placeholder="Wachtwoord"
                        class="w-full mt-2"
                        v-model="password"
                    />
                </div>
                <div>
                    <p class="pt-1 mt-5 text-2xl text-white font-primary">
                        Eisen voor wachtwoord:
                    </p>
                    <div class="flex items-center mt-2 text-white gap-x-2">
                        <span :class="password ? 'text-' + passwordStrengthArray[(passwordLengthScore - 1)].color : 'text-gray-200'">Lengte:</span>
                        <div class="w-full h-1.5 bg-gray-200 rounded-md">
                            
                            <div
                                v-if="passwordLengthScore > 0"
                                class="h-1.5 rounded-md"
                                :class="'bg-' + passwordStrengthArray[(passwordLengthScore - 1)].color"
                                :style="{ width: (passwordLengthScore * 20) + '%' }"
                                
                            ></div>
                            <div
                                v-if="passwordLengthScore === 0"
                                class="h-1.5 bg-red-400 rounded-md w-[0%]"
                            ></div>
                        </div>
                    </div>
                    <div class="flex items-center mt-3 text-white gap-x-2">
                        <svg
                            v-if="!hasUppercase"
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            viewBox="0 -960 960 960"
                            :class="
                                hasUppercase ? 'fill-green-400' : 'fill-red-400'
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
                                hasUppercase ? 'fill-green-400' : 'fill-red-400'
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
                                hasUppercase ? 'text-green-400' : 'text-red-400'
                            "
                        >
                            bevat een hoofdletter
                        </span>
                    </div>
                    <div class="flex items-center mt-2 text-white gap-x-2">
                        <svg
                            v-if="!hasDigit"
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            viewBox="0 -960 960 960"
                            :class="
                                hasDigit ? 'fill-green-400' : 'fill-red-400'
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
                                hasDigit ? 'fill-green-400' : 'fill-red-400'
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
                                hasDigit ? 'text-green-400' : 'text-red-400'
                            "
                        >
                            bevat een getal
                        </span>
                    </div>
                    <div class="flex mt-2 text-white gap-x-2">
                        <svg
                            v-if="!hasSpecial"
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            viewBox="0 -960 960 960"
                            :class="
                                hasSpecial ? 'fill-green-400' : 'fill-red-400'
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
                                hasSpecial ? 'fill-green-400' : 'fill-red-400'
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
                                hasSpecial ? 'text-green-400' : 'text-red-400'
                            "
                        >
                            bevat een speciaal teken
                        </span>
                    </div>
                    <div
                        v-if="password && password.length > 0"
                        class="flex items-center mt-2 text-white gap-x-2"
                    >
                        <svg
                            v-if="isCommon"
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            viewBox="0 -960 960 960"
                            :class="
                                hasSpecial ? 'fill-green-400' : 'fill-red-400'
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
                                isCommon ? 'fill-red-400' : 'fill-green-400'
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
                                isCommon ? 'text-red-400' : 'text-green-400'
                            "
                        >
                            {{
                                isCommon
                                    ? "veel voorkomend"
                                    : "niet veel voorkomend"
                            }}
                        </span>
                    </div>
                    <div
                        v-if="password && password.length > 0"
                        class="flex mt-2 text-white gap-x-2"
                    >
                        <p>Eindscore:</p>
                        <span>{{ passwordEndScore }}</span>
                    </div>
                </div>
                <div class="mt-7">
                    <img
                        src="../../img/hacksclusive-logo.png"
                        class="w-32 h-7"
                        alt="hacksclusive-logo"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
