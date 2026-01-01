import { defineStore } from "pinia";
import api from "@/utils/axios";

export const useBlogStore = defineStore("blog", {
  state: () => ({
    posts: [],
    selectedPost: {title: '[Title]', text: '[Body]', user: {name: '[Author]'}},
    query: {string: '', regex: false, column: 'default'}
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
        console.log(this.query.column)
        const posts = await api.get(
            `api/searchblog?pattern=${this.query.string}&regex=${this.query.regex}&column=${this.query.column}`);
        this.posts = posts.data; 
    },
    async getUserPosts(id) {
        const posts = await api.get(`api/userblog/${id}`);
        this.posts = posts.data;
        return posts.data[0].user;
    },
    async getFollowedPosts() {
      const posts = await api.get(`api/followedblogs`);
      this.posts = posts.data; 
    }
  },
});
