import axios, { AxiosInstance } from 'axios';
import { GitUser } from '../models/GitUser';
import { GitRepo } from '../models/GitRepo';

export class GitUsersRepository {
    private client: AxiosInstance

    constructor() {
        this.client = axios.create({
            baseURL: 'https://api.github.com/users/'
        })
    }

    public async fetchUser(username: string): Promise<GitUser> {
        const response = await this.client.get(username)
        return response.data as GitUser
    }

    public async fetchRepos(username: string): Promise<GitRepo[]> {
        const response = await this.client.get(`${username}/repos?per_page=100`)
        return response.data as GitRepo[]
    }

}
