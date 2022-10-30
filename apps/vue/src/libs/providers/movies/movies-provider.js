import axios from "axios";

const ENDPOINT = process.env.VUE_APP_MOVIES_ENDPOINT

export const async_find_all = async () => {
    try {
        const movies = await axios.get(ENDPOINT)
        return movies.data
    } catch (err) {
        console.log("movies async find all error")
        return []
    }
}