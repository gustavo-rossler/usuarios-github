<script setup lang="ts">
import { computed, onMounted } from 'vue'
import { useGitUsersStore } from '../stores/gitUsers'
import { userFormattedDate } from '../models/GitUser'

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

  <div class="text-center mt-4">
    <div class="spinner-border" role="status" v-if="loading">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

  <p v-if="error" class="alert alert-danger mt-4">{{ error }}</p>

  <div class="list-group list-group-flush mt-4" v-if="users.length > 0">
    <router-link
      :to="`/user/${ user.login }`"
      v-for="user in users"
      :key="user.id"
      class="list-group-item list-group-item-action d-flex justify-content-between align-items-start"
    >
      <img :src="user.avatar_url" class="avatar" />
      <div class="ms-2 me-auto">
        <div class="fw-bold">{{ user.name }}</div>
        Usuário desde <b>{{ userFormattedDate(user.created_at) }}</b>
      </div>
      <span class="badge bg-secondary rounded-pill">{{ user.public_repos }}</span>
    </router-link>
  </div>
</template>


<style scoped>
a {
  text-decoration: none;
  color: inherit;
  display: contents;
}
a:hover > li {
  background-color: #eee;
}
.avatar {
  width: 60px;
  border-radius: 50%;
}
</style>