<script setup>
import { ref,computed } from 'vue';
import { useFetchJson } from "@/utils/useFetchJson";
import ChapterContainer from "@/components/ChapterContainer.vue";
import { anchor } from '../../stores/router';
const anchorParts = ref(anchor.value.split("-"));
const url = ref(`/api/v1/stories/${anchorParts.value[1]}/chapters`);
const { data: data, error, isLoading } = useFetchJson(url.value);
const story = computed(() => data.value?.story || []);
const chapters = computed(() => data.value?.chapters || []);
</script>

<template>
    <div v-if="isLoading">Loading...</div>
    <div v-else-if="error">Error loading stories: {{ error.message }}</div>
    <div v-else>
        <h1>{{ story.title }}</h1>
        <ChapterContainer
            v-for="(chapter, index) in chapters"
            :key="chapter.id"
            :id="chapter.id"
            :content="chapter.content"
            :number="chapter.number"
            :storyId="chapter.storyId"
            @remove="chapter.splice(index, 1)">
        </ChapterContainer>
    </div>
</template>

<style scoped>
  
</style>