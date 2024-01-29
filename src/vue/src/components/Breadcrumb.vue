<script setup lang="ts">
defineProps<{
    userName: string,
}>()
</script>

<template>
    <div class="mb-4 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item">
                    <router-link to="/">Inicio</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ userName }}</li>
            </ol>
        </nav>
    </div>
</template>
