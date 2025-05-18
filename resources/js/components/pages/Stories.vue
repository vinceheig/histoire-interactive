<script setup>
import { ref, onMounted } from 'vue';
import { useFetchJson } from "@/utils/useFetchJson";
import StoryContainer from "@/components/StoryContainer.vue";

const url = "/api/v1/stories";
const {
    data: stories,
    error: storiesError,
    loading: storiesLoading,
    execute: executeStoriesFetch,
    abort: abortStoriesFetch
  } = useFetchJson({url: url, immediate: false});

const changeUrl = (page) => {
  window.location.hash = page;
};
onMounted(() => {
  if (!stories.value) {
    try {
      useFetchJson('/api/v1/stories');
    } catch (e) {
      console.error('Error fetching stories:', e);
    }
  }
});
</script>

<template>
  <div class="stories-container" >
    <h1>Welcome to the Stories App</h1>
    <p>Here are some stories:</p>
    
    <div v-if="storiesLoading">Loading...</div>
    <div v-else-if="storiesError">Error loading stories: {{ storiesError.message }}</div>
    <div v-else-if="stories?.data" class="stories-grid">
      <StoryContainer
        v-for="story in stories.data"
        :key="story.id"
        :id="story.id"
        :title="story.title"
        :summary="story.summary"
        :author="story.author"
      />
    </div>
  </div>
</template>

<style scoped>
.stories-container {
  padding: 2rem;
}

.stories-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 2rem;
  padding: 1rem;
}
</style>
