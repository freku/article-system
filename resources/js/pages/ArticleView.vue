<script setup>
import { computed } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useFetchWithData } from "../composable/fetchWithData";
import ArticlePost from "../components/article/ArticlePost.vue";
import ArticlePreFetch from "../components/article/ArticleViewLayout.vue";

const router = useRouter();
const route = useRoute();

const url = computed(() => {
  if (route.params.articleId) {
    return `/api/article/${route.params.articleId}`;
  }

  return null;
});

const { data: article, fetched: articleFetched } = useFetchWithData(url);

</script>

<template>
  <ArticlePreFetch :article-fetched="articleFetched">
    <ArticlePost
      class="md:mx-20"
      :article-id="article.id"
      :title="article.title"
      :content="article.content"
      :authors="article.authors"
      :clip-content="false"
    >
      <button
        class="text-green-500 underline"
        @click="
          router.push({
            name: 'editArticle',
            params: { articleId: article.id },
          })
        "
      >
        edit
      </button>
    </ArticlePost>
  </ArticlePreFetch>
</template>
