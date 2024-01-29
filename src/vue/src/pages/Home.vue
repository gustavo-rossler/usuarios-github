<script setup lang="ts">
import { computed, onMounted } from 'vue'
import { useGitUsersStore } from '../stores/gitUsers'
//
import Loading from '../components/Loading.vue'
import UserListItem from '../components/UserListItem.vue'

const store = useGitUsersStore()

const users = computed(() => store.gitUsers)
const loading = computed(() => store.loading)
const error = computed(() => store.error)

onMounted(() => {
    store.fetchUsers()
})

</script>

<template>
    <h1 class="mt-4">Usuários Github</h1>

    <Loading v-if="loading" class="my-4" />

    <p v-if="error" class="alert alert-danger mt-4">{{ error }}</p>

    <div class="list-group list-group-flush mt-4" v-if="users.length > 0">
        <UserListItem :users="users" />
    </div>
</template>
