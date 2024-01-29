<script setup lang="ts">
import { GitUser } from '../models/GitUser'
import { userFormattedDate } from '../models/GitUser'
//
import locationIcon from '/location_on_icon.png'
import calendarIcon from '/calendar_contact_perm_ic_icon.png'
import twitterIcon from '/twitter_bird_icon.png'
import FollowInfo from './FollowInfo.vue'

defineProps<{
    user: GitUser,
}>()
</script>

<template>
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
                    <a :href="`https://twitter.com/${user.twitter_username}`" target="_blank">
                        {{ user.twitter_username }}
                    </a>
                </p>
                <p>
                    <img :src="calendarIcon" class="icon" />
                    Desde <b>{{ userFormattedDate(user.created_at) }}</b>
                </p>
                <div class="row">
                    <FollowInfo label="seguidores" :total="user.followers" />
                    <FollowInfo label="seguindo" :total="user.following" />
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
</template>

<style scoped>
.icon {
    width: 24px;
}
</style>
