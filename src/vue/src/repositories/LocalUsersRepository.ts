import axios, { AxiosInstance } from 'axios';

export class LocalUsersRepository {
    private client: AxiosInstance

    constructor() {
        this.client = axios.create({
            baseURL: 'http://localhost:3008/',
        })
    }

    public async saveUser(username: string): Promise<string> {
        const response = await this.client.post('salvar-local', {
            username
        }, {
            withCredentials: false,
        })
        return response.data.filename as string
    }

}
