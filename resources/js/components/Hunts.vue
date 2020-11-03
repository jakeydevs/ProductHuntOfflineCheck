<template>
    <div class="w-full space-y-8 p-10">
        <Hunt v-for="hunt in data" :key="hunt.id" :hunt="hunt" :api="api" />
    </div>
</template>

<script>
import Hunt from "./Hunt";

export default {
    props: {
        data: {
            required: true,
            type: Array
        },
        api: {
            required: true,
            type: String
        }
    },
    component: {
        Hunt
    }
};
</script>
