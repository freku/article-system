<script setup>
import { computed, unref, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useFetchWithData } from '../composable/fetchWithData'
import ArticlePreFetch from "../components/article/ArticleViewLayout.vue";
import { useToast } from '../composable/toastState';
import axios from "axios";
import ArticleForm from '../components/article/ArticleForm.vue';

const router = useRouter()
const { successToast, dangerToast } = useToast()

const article = ref({
    title: '',
    content: '',
    authors: [],
})

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

const createArticle = async () => {
  try {
    const result = await axios.post(`/api/article`, articleBody.value)

    if (result.status === 201) {
      successToast.show('Article created successfully!')
      router.push({name: 'viewArticle', params: {articleId: result.data.id}})
    }
  } catch (errors) {
    dangerToast.show(errors.response.data.message)
  }
}

</script>

<template>
  <ArticlePreFetch :article-fetched="authorsFetched">
    <ArticleForm
      v-model:title="article.title"
      v-model:content="article.content"
      save-text="create"
      cancel-text="cancel"
      :article="article"
      :authors="authors"
      @remove-author="removeAuthorFromPicked"
      @add-author="addAuthorToArticle"
      @save="createArticle"
      @cancel="router.push({name: 'home'})"
    />
  </ArticlePreFetch>
</template>
