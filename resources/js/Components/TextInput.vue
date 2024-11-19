<script setup>
import { watch } from 'vue';
import { onMounted, ref } from 'vue';

const props = defineProps({
    value: {
        default: "",
    }
});

const emit = defineEmits(['changeModel']);

const model = ref(props.value)
const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

watch(() => props.value, (newValue) => {
    model.value = newValue;
});

defineExpose({ focus: () => input.value.focus() });

const returnModel = () => {
    emit('changeModel', model.value);
};
</script>

<template>
    <input
        class="border-gray-300 rounded-md shadow-sm focus:border-[#b08bff] focus:border-3 focus:ring-[#b08bff]"
        v-model="model"
        @input="returnModel"
        ref="input"
    />
</template>
