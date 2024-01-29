import { defineStore } from 'pinia';
import { GitUser } from '../models/GitUser';
import { GitUsersRepository } from '../repositories/GitUsersRepository';
import { LocalUsersRepository } from '../repositories/LocalUsersRepository';

interface State {
    gitUsers: GitUser[]
    searchText: string
    gitUser?: GitUser
    loading: boolean
    error?: string
    loadingSave?: boolean
    fileSaved?: string
    errorSave?: string
}

export const useGitUsersStore = defineStore('gitUsers', {
    state: (): State => ({
        gitUsers: [] as GitUser[],
        searchText: '',
        gitUser: undefined,
        loading: false,
        error: undefined,
    }),
    getters: {
        getGitUsers(state): GitUser[] {
            return state.gitUsers.filter(
                (user) => user.name.toLocaleLowerCase()
                    .indexOf(this.searchText.toLocaleLowerCase()) >= 0
            )
        },
    },
    actions: {
        setSearchText(text: string) {
            this.searchText = text
        },
        async fetchUsers() {
            try {
                if (this.gitUsers.length > 0) {
                    return
                }

                this.loading = true
                this.error = undefined
                const users = [
                    'wallysonn',
                    'diego3g',
                    'filipedeschamps',
                    'rmanguinho',
                ]
                this.gitUsers = []

                const repository = new GitUsersRepository()

                const newRepos = []
                for (const user of users) {
                    newRepos.push(await repository.fetchUser(user))
                }
                this.gitUsers = newRepos
            } catch (e: any) {
                this.error = e?.response?.data?.message ?? e
            } finally {
                this.loading = false
            }
        },
        async fetchUser(username: string) {
            try {
                const repository = new GitUsersRepository()
                this.gitUser = undefined
                this.error = undefined
                this.loading = true
                this.gitUser = await repository.fetchUser(username)
                this.gitUser.repos = await repository.fetchRepos(username)
            } catch (e: any) {
                this.error = e?.response?.data?.message ?? e
            } finally {
                this.loading = false
            }
        },
        async saveLocally(username: string) {
            try {
                const repository = new LocalUsersRepository()
                this.fileSaved = undefined
                this.errorSave = undefined
                this.loadingSave = true
                this.fileSaved = await repository.saveUser(username)
            } catch (e: any) {
                this.errorSave = e?.response?.data?.message ?? e
            } finally {
                this.loadingSave = false
            }
        },
        clearSave() {
            this.fileSaved = undefined
            this.errorSave = undefined
            this.loadingSave = false
        },
    },
})
