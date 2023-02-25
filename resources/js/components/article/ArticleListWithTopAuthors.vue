<script setup>
import ArticlePost from './ArticlePost.vue';
import TopAuthors from '../TopAuthors.vue';
import { useFetchWithData } from '../../composable/fetchWithData';
import LoadingSpinner from '../LoadingSpinner.vue';

const props = defineProps({
    articles: {
        type: Array,
        default: () => [],
    },
    articlesFetched: {
        type: Boolean,
        required: true,
    },
})

const {
    data: authors,
    fetched: authorsFetched,
} = useFetchWithData('/api/author/top3')

</script>

<template>
  <div>
    <div
      v-if="!articlesFetched || !authorsFetched"
      class="container flex justify-center mx-auto mt-16"
    >
      <LoadingSpinner classes="w-20 h-20" />
    </div>
    <div
      v-else
      class="container mx-auto my-16 px-6 flex lg:flex-row flex-col relative"
    >
      <div class="lg:w-2/3 lg:mr-6 lg:mt-0 mt-6 lg:order-first order-last">
        <router-link
          v-for="article in articles"
          :key="article.id"
          :to="{ name: 'viewArticle', params: { articleId: article.id } }"
        >
          <ArticlePost
            :article-id="article.id"
            :title="article.title"
            :content="article.content"
            :authors="article.authors"
            show-hover-effect
            clip-content
          />
        </router-link>
      </div>

      <div class="lg:w-1/3">
        <TopAuthors :authors="authors" />
      </div>
    </div>
  </div>
</template>
