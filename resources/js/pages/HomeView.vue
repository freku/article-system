<script setup>
import { useFetchWithData } from "../composable/fetchWithData";
import ArticleListWithTopAuthors from "../components/article/ArticleListWithTopAuthors.vue";

const { data: articles, fetched: articlesFetched } =
  useFetchWithData("/api/articles");
</script>

<template>
  <ArticleListWithTopAuthors
    :articles="articles"
    :articles-fetched="articlesFetched"
  />
</template>
