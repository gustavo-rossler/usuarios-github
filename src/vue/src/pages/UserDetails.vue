<script setup lang="ts">
import { computed, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { useGitUsersStore } from '../stores/gitUsers'
import { userFormattedDate } from '../models/GitUser';
import locationIcon from '/location_on_icon.png'
import calendarIcon from '/calendar_contact_perm_ic_icon.png'
import twitterIcon from '/twitter_bird_icon.png'
import repoIcon from '/bx_git_repo_forked_icon.png'

const route = useRoute()
const store = useGitUsersStore()

const user = computed(() => store.gitUser)
const loading = computed(() => store.loading)
const error = computed(() => store.error)

onMounted(() => {
    const { username } = route.params
    store.fetchUser(username)
})

console.log(user)

</script>
<template>
    <div class="text-center mt-4">
        <div class="spinner-border" role="status" v-if="loading">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div v-if="error">
        <h1>Ops!</h1>
        <p>Ocorreu um erro durante a sua requisição</p>
        <p>
            <a class="" data-bs-toggle="collapse" href="#collapseErrorInfo" role="button" aria-expanded="false" aria-controls="collapseExample">
                Ver mais detalhes
            </a>
        </p>
        <div class="collapse" id="collapseErrorInfo">
            <p class="alert alert-danger mt-4">{{ error }}</p>
        </div>
    </div>

    <div v-if="!loading && user" class="mt-4">
        <div class="mb-4 border-bottom">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item">
                        <router-link to="/">Inicio</router-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ user.name }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-3">
                <img :src="user.avatar_url" class="rounded-circle w-100" />
            </div>
            <div class="col-9">
                <div>
                    <h1>{{ user.name }}</h1>
                    <p>{{ user.bio }}</p>
                    <p v-if="user.location">
                        <img :src="locationIcon" class="icon" /> {{ user.location }}
                    </p>
                    <p v-if="user.twitter_username">
                        <img :src="twitterIcon" class="icon" />
                        <a :href="`https://twitter.com/${ user.twitter_username }`" target="_blank">
                            {{ user.twitter_username }}
                        </a>
                    </p>
                    <p>
                        <img :src="calendarIcon" class="icon" />
                        Desde <b>{{ userFormattedDate(user.created_at) }}</b>
                    </p>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="p-3 bg-light border-bottom">
                                <h3>{{ user.followers }}</h3>
                                <p>seguidores</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="p-3 bg-light border-bottom">
                                <h3>{{ user.following }}</h3>
                                <p>seguindo</p>
                            </div>
                        </div>
                    </div>

                    <div class="row py-2" v-if="user.blog">
                        <div class="col-12 col-sm-3"><b>Blog</b></div>
                        <div class="col-12 col-sm-9">
                            <a :href="user.blog" target="_blank">{{ user.blog }}</a>
                        </div>
                    </div>
                    <div class="row py-2" v-if="user.company">
                        <div class="col-12 col-sm-3"><b>Empresa</b></div>
                        <div class="col-12 col-sm-9">{{ user.company }}</div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="border-bottom py-3 mt-4 mb-0">
            <img :src="repoIcon" class="icon" /> repos
        </h3>
        <div class="list-group list-group-flush">
            <a
                :href="repo.html_url"
                v-for="repo in user.repos"
                :key="repo.id"
                class="list-group-item list-group-item-action"
                target="_blank"
            >
                <h5>{{ repo.name }}</h5>
                <p>{{ repo.description }}</p>
            </a>
        </div>

        <div class="mb-5 text-center py-2 border-top">
            <button class="btn btn-dark">Salvar localmente</button>
        </div>
    </div>
</template>

<style scoped>
.icon {
    width: 24px;
}
</style>