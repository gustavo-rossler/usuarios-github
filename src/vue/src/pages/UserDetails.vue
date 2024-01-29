<script setup lang="ts">
import { computed, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { useGitUsersStore } from '../stores/gitUsers'
//
import Loading from '../components/Loading.vue'
//

import Breadcrumb from '../components/Breadcrumb.vue';
import UserDetailsHero from '../components/UserDetailsHero.vue';
import RepoList from '../components/RepoList.vue';
import ButtonSave from '../components/ButtonSave.vue';

const route = useRoute()
const store = useGitUsersStore()

const user = computed(() => store.gitUser)
const loading = computed(() => store.loading)
const error = computed(() => store.error)

const { username } = route.params

onMounted(() => {
    store.fetchUser(username.toString())
    store.clearSave()
})



</script>
<template>
    <Loading v-if="loading" class="my-4" />

    <div v-if="error">
        <h1>Ops!</h1>
        <p>Ocorreu um erro durante a sua requisição</p>
        <p>
            <a class="" data-bs-toggle="collapse" href="#collapseErrorInfo" role="button" aria-expanded="false"
                aria-controls="collapseExample">
                Ver mais detalhes
            </a>
        </p>
        <div class="collapse" id="collapseErrorInfo">
            <p class="alert alert-danger mt-4">{{ error }}</p>
        </div>
    </div>

    <div v-if="!loading && user" class="mt-4">
        <Breadcrumb :user-name="user.name" />
        <UserDetailsHero :user="user" />
        <RepoList :repos="user.repos" v-if="user.repos" />
        <ButtonSave :username="username.toString()" />
    </div>
</template>

<style scoped>
.icon {
    width: 24px;
}
</style>
