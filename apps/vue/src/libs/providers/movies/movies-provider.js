import axios from "axios";

const ENDPOINT = process.env.VUE_APP_MOVIES_ENDPOINT

const _async_find_all = async () => {
    try {
        const movies = await axios.get(ENDPOINT)
        return movies.data
    } catch (err) {
        console.log("movies async find all error")
        return []
    }
}

const movies = {
    async_find_all: _async_find_all
}

export default movies