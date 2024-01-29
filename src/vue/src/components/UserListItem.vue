<script setup lang="ts">
import { GitUser } from '../models/GitUser'
import { userFormattedDate } from '../models/GitUser'

defineProps<{
    users: GitUser[],
}>()
</script>

<template>
    <router-link :to="`/user/${user.login}`" v-for="user in users" :key="user.id"
        class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
        <img :src="user.avatar_url" class="avatar" />
        <div class="ms-2 me-auto">
            <div class="fw-bold">{{ user.name }}</div>
            Usuário desde <b>{{ userFormattedDate(user.created_at) }}</b>
        </div>
        <span class="badge bg-secondary rounded-pill">{{ user.public_repos }}</span>
    </router-link>
</template>

<style scoped>
a {
    text-decoration: none;
    color: inherit;
    display: contents;
}

a:hover>li {
    background-color: #eee;
}

.avatar {
    width: 60px;
    border-radius: 50%;
}
</style>
