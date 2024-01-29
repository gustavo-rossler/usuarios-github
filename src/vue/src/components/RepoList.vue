<script setup lang="ts">
import { GitRepo } from '../models/GitRepo';
import repoIcon from '/bx_git_repo_forked_icon.png'
defineProps<{
    repos: GitRepo[],
}>()
</script>

<template>
    <h3 class="border-bottom py-3 mt-4 mb-0">
        <img :src="repoIcon" class="icon" /> repos
    </h3>
    <div class="list-group list-group-flush">
        <a :href="repo.html_url" v-for="repo in repos" :key="repo.id" class="list-group-item list-group-item-action"
            target="_blank">
            <h5>{{ repo.name }}</h5>
            <p>{{ repo.description }}</p>
        </a>
    </div>
</template>

<style scoped>
.icon {
    width: 24px;
}
</style>