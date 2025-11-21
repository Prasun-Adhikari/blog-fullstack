import { defineStore } from "pinia";
import api from "@/utils/axios";

export const useBlogStore = defineStore("blog", {
  state: () => ({
    posts: [],
    selectedPost: {title: '[Title]', text: '[Body]', user: {name: '[Author]'}},
    query: {string: '', type: ''}
  }),

  getters: {},

  actions: {
    async fetchAllPosts() {
      const allposts = await api.get("api/blog");
      this.posts = allposts.data;
    },
    selectPost(id) {
      this.selectedPost = this.posts.filter((post) => post.id == id)[0];
    },
    async searchPosts() {
        const posts = await api.get(`api/searchblog?pattern=${this.query.string}&type=${this.query.type}`);
        this.posts = posts.data; 
    },
    async getUserPosts(id) {
        const posts = await api.get(`api/userblog/${id}`);
        this.posts = posts.data; 
    },
  },
});
