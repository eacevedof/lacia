const emptykeyvalue = {key:"",value:""}

const get_distinct_years = movies => [emptykeyvalue, ...Array.from(new Set(movies.map(movie => movie?.releaseYear ?? 0))).sort().map(year => ({key:year,value:year}))]
const get_distinct_types = movies => [emptykeyvalue, ...Array.from(new Set(movies.map(movie => movie?.programType ?? 0))).sort().map(type => ({key:type,value:type}))]
const get_orderby_values = () => [emptykeyvalue, {key:"name",value:"Name"}, {key:"year",value:"Year"}]

const get_filtered_by_type = (type, movs) => movs.filter(movie => movie?.programType === type)
const get_filtered_by_year = (year, movs) => movs.filter(movie => movie?.releaseYear === year)

const _order_by_name = (moviea, movieb) => {
    if (moviea.title > movieb.title) return 1
    if (moviea.title < movieb.title) return -1
    return 0
}

const _order_by_year = (moviea, movieb) => {
    const yearA = parseInt(moviea?.releaseYear) ?? 0
    const yearB = parseInt(movieb?.releaseYear) ?? 0
    if (yearA > yearB) return 1
    if (yearA < yearB) return -1
    return 0
}

const get_ordered_by_year = (year, movs) => movs.sort(_order_by_year)
const get_ordered_by_name = (name, movs) => movs.sort(_order_by_name)


const filters  = {
    //caga de selectores
    get_distinct_years,
    get_distinct_types,
    get_orderby_values,

    //aplicacion de filtros
    get_filtered_by_year,
    get_filtered_by_type,
    get_ordered_by_name,
    get_ordered_by_year
}

export default filters