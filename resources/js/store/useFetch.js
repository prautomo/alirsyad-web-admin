import useSWR from 'swr'

export default function useFetch(url ) {
    const { data, error } = useSWR(url, window.getAxios)
    return {
        data: data,
        isLoading: !error && !data,
        isError: error
    }
}