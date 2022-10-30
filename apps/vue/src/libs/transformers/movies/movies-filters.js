let movies = []


const get_distinct_years = () => Array.from(new Set(movies.map(movie => movie?.releaseYear ?? 0))).sort()

const get_distinct_types = () => Array.from(new Set(movies.map(movie => movie?.programType ?? 0))).sort()

const get_orderby_values = () => [{key:"name",value:"Name"}, {key:"year",value:"Year"}]
    // Se podrá ordenar por: nombre, año.
    // Se podrá filtrar por: año, película o serie.


const movieTransform  = {
    get_distinct_years,
    get_distinct_types,
    get_orderby_values,

}

export const setMovies = movs => movies = movs

export default movieTransform