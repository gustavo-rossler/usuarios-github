<script setup lang="ts">
import { computed } from 'vue'
import { useGitUsersStore } from '../stores/gitUsers'
import Loading from './Loading.vue'

const store = useGitUsersStore()

const fileSaved = computed(() => store.fileSaved)
const loadingSave = computed(() => store.loadingSave)
const errorSave = computed(() => store.errorSave)

const props = defineProps<{
    username: string
}>()

const saveUserLocally = async (): Promise<void> => {
    await store.saveLocally(props.username.toString())
}

</script>

<template>
    <div class="mb-5 text-center py-3 border-top">
        <button class="btn btn-dark" @click="saveUserLocally" :disabled="loadingSave">Salvar localmente</button>
        <div v-if="fileSaved || loadingSave" class="fade show my-3" role="alert">
            <p v-if="fileSaved" class="text-success">Usuário salvo <b>{{ fileSaved }}</b></p>
            <Loading v-if="loadingSave" />
        </div>
        <p v-if="errorSave" class="text-danger my-3">{{ errorSave }}</p>
    </div>
</template>