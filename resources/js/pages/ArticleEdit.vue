<script setup>
import { computed, unref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useFetchWithData } from '../composable/fetchWithData'
import ArticlePreFetch from "../components/article/ArticleViewLayout.vue";
import { useToast } from '../composable/toastState';
import axios from "axios";
import ArticleForm from '../components/article/ArticleForm.vue';

const route = useRoute()
const router = useRouter()
const { successToast, dangerToast } = useToast()

const url = computed(() => {
  if (route.params.articleId) {
    return `/api/article/${route.params.articleId}`
  }

  return null
})

const {
  data: article,
  fetched: articleFetched,
} = useFetchWithData(url)

const {
  data: authors,
  fetched: authorsFetched,
} = useFetchWithData('/api/authors')

const addAuthorToArticle = (author) => {
  article.value.authors.push(author)
}

const removeAuthorFromPicked = (author) => {
    article.value.authors = article.value.authors.filter((a) => a.id !== author.id);
}

const articleBody = computed(() => {
  const unrefedArticle = unref(article)

  return {
    title: unrefedArticle.title,
    content: unrefedArticle.content,
    authors: unrefedArticle.authors.map(el => el.id)
  }
})

const saveArticle = async () => {
  try {
    const result = await axios.put(`/api/article/${article.value.id}`, articleBody.value)

    if (result.status === 200) {
      successToast.show('Article updated successfully!')
      router.push({name: 'viewArticle', params: {articleId: article.value.id}})
    }
  } catch (errors) {
    dangerToast.show(errors.response.data.message)
  }
}

</script>

<template>
  <ArticlePreFetch :article-fetched="articleFetched && authorsFetched">
    <ArticleForm
      v-model:title="article.title"
      v-model:content="article.content"
      save-text="save"
      cancel-text="cancel"
      :article="article"
      :authors="authors"
      @remove-author="removeAuthorFromPicked"
      @add-author="addAuthorToArticle"
      @save="saveArticle"
      @cancel="router.push({name: 'viewArticle', params: {articleId: article.id}})"
    />
  </ArticlePreFetch>
</template>
