import { GitRepo } from './GitRepo'

export interface GitUser {
    avatar_url: string
    bio?: string
    blog?: string
    company?: string
    create_at: string
    email?: string
    followers: number
    following: number
    id: number
    location?: string
    name: string
    login: string
    public_repos: number
    repos_url: string
    twitter_username?: string

    repos?: GitRepo[]
}

export const userFormattedDate = (created_at: string): string => {
    return new Date(created_at).toLocaleDateString('pt-BR')
}
