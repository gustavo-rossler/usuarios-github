<script setup lang="ts">
defineProps<{
    label: string,
    total: number,
}>()
</script>

<template>
    <div class="col-12 col-sm-6">
        <div class="p-3 bg-light border-bottom">
            <h3>{{ total }}</h3>
            <p>{{ label }}</p>
        </div>
    </div>
</template>