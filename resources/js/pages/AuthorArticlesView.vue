<script setup>
import { useRoute } from 'vue-router'
import { computed } from 'vue';
import { useFetchWithData } from '../composable/fetchWithData';
import ArticleListWithTopAuthors from '../components/article/ArticleListWithTopAuthors.vue';

const route = useRoute()
const url = computed(() => {
    if (route.params.authorId) {
        return `/api/author/${route.params.authorId}/articles`
    }

    return null
})

const {
    data: articles,
    fetched: articlesFetched,
} = useFetchWithData(url)

</script>

<template>
  <ArticleListWithTopAuthors
    :articles="articles"
    :articles-fetched="articlesFetched"
  />
</template>
