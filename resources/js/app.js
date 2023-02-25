import "./bootstrap";

import { createApp } from "vue";

import { createRouter, createWebHistory } from "vue-router";

import HomeView from "./pages/HomeView.vue";
import ArticleView from "./pages/ArticleView.vue";
import ArticleEdit from "./pages/ArticleEdit.vue";
import ArticleCreate from "./pages/ArticleCreate.vue";
import AuthorArticlesView from "./pages/AuthorArticlesView.vue";

import App from "./App.vue";

const routes = [
  {
    path: "/",
    component: HomeView,
    name: "home",
  },
  {
    path: "/article/:articleId(\\d+)",
    component: ArticleView,
    name: "viewArticle",
  },
  {
    path: "/new-article",
    component: ArticleCreate,
    name: "createArticle",
  },
  {
    path: "/article/:articleId(\\d+)/edit",
    component: ArticleEdit,
    name: "editArticle",
  },
  {
    path: "/author/:authorId(\\d+)/articles",
    component: AuthorArticlesView,
    name: "authorArticles",
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

const app = createApp(App);

app.use(router);

app.mount("#app");
