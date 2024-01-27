import { defineStore } from 'pinia';
import { GitUser } from '../models/GitUser';
import { GitUsersRepository } from '../repositories/GitUsersRepository';

interface State {
    gitUsers: GitUser[]
    gitUser?: GitUser
    loading: boolean
    error?: string
}

export const useGitUsersStore = defineStore('gitUsers', {
    state: (): State => ({
        gitUsers: [] as GitUser[],
        gitUser: undefined,
        loading: false,
        error: undefined,
    }),
    getters: {
        getRepos(state): GitUser[] {
            return state.gitUsers
        }
    },
    actions: {
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
            } catch (error: any) {
                this.error = error
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
            } catch (error: any) {
                this.error = error
            } finally {
                this.loading = false
            }
        },
    },
})
