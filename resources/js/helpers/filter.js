export function numberFormat (value) {
    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
}
