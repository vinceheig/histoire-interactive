<script setup>
import { ref } from 'vue';
import { useFetchJson } from "@/utils/useFetchJson";
import StoryContainer from "@/components/StoryContainer.vue";

const url = ref("/api/v1/stories");
const { data: stories, error, isLoading } = useFetchJson(url.value);
</script>

<template>
   
    <h1>Welcome to the Stories App</h1>
    <p>Here are some stories:</p>
    <div v-if="isLoading">Loading...</div>
    <div v-else-if="error">Error loading stories: {{ error.message }}</div>
    <div v-else>
        <StoryContainer
            v-for="(story, index) in stories"
            :key="story.id"
            :id="story.id"
            :title="story.title"
            :summary="story.summary"
            :author="story.author"
            @remove="stories.splice(index, 1)"
        >
        </StoryContainer>
    </div>
</template>

<style scoped>

</style>
