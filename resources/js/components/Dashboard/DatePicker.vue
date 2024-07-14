<script setup>
import {ref, watch} from "vue";
import moment from "moment/moment.js";

const props = defineProps({
    label: String,
});

const date = ref(new Date().toLocaleDateString('en-ca'));

const emits = defineEmits(['changeDate']);
const changeDate = (event) => {
    const formatedDate = moment(event).format('YYYY-MM-DD');
    emits('changeDate', formatedDate);
};
</script>

<template>
    <div class="col-6">
        <div class="surface-card shadow-2 p-3 border-round">
            <div>
                <span class="block text-500 font-medium mb-3">{{ label }}</span>
                <div class="text-900 font-medium text-xl">
                    <Calendar v-model="date"
                              @dateSelect="changeDate"
                              dateFormat="yy/mm/dd" />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
