<script setup>
import { ref, computed, onMounted, watchEffect } from "vue";
import { useFetchJson } from "@/utils/useFetchJson";
import ChapterContainer from "@/components/ChapterContainer.vue";
import ChoiceContainer from "../ChoiceContainer.vue";

const props = defineProps({
    number: {
        type: String,
        required: true,
    },
});

const anchor = ref(window.location.hash.split("-"));
const chapterUrl = ref(`/api/v1/stories/${anchor.value[1]}/chapters`);

// Fetch chapters
const {
    data: chapters,
    error: chaptersError,
    loading: chaptersLoading,
    execute: executechaptersFetch
} = useFetchJson({ url: chapterUrl.value, immediate: true });

// Get current chapter
const currentChapter = computed(() => {
    if (!chapters.value?.data?.chapters) return null;
    return chapters.value.data.chapters.find(
        chapter => chapter.number === props.number
    );
});

// Choices state
const choices = ref(null);
const choicesError = ref(null);
const choicesLoading = ref(false);

// Fetch choices when chapter is available
watchEffect(async () => {
    if (currentChapter.value?.id) {
        choicesLoading.value = true;
        try {
            const response = await fetch(`/api/v1/chapters/${currentChapter.value.id}/choices`);
            const data = await response.json();
            choices.value = data;
        } catch (error) {
            choicesError.value = error;
        } finally {
            choicesLoading.value = false;
        }
    }
});
const end = () => {
    window.location = "/";
}
const retry = () => {
    window.location.hash = `story-${anchor.value[1]}-1`;
}
</script>

<template>
    <div v-if="chaptersLoading">Loading...</div>
    <div v-else-if="chaptersError">
        Error loading chapters: {{ chaptersError.message }}
    </div>
    <div v-else-if="currentChapter">
        <h1>{{ chapters.data.story.title }}</h1>
        <ChapterContainer
            :key="currentChapter.id"
            :id="currentChapter.id"
            :content="currentChapter.content"
            :number="currentChapter.number"
            :storyId="currentChapter.storyId"
        />

        <!-- Choices Section -->
        <div v-if="choicesLoading">Loading choices...</div>
        <div v-else-if="choicesError">
            Error loading choices: {{ choicesError.message }}
        </div>
        <div v-else-if="choices?.data.choices.length > 0" class="choices-container">
            <h2>What would you like to do?</h2>
            <ChoiceContainer
                v-for="choice in choices.data.choices"
                :key="choice.id"
                :id="choice.id"
                :text="choice.text"
                :nextChapterId="choice.nextChapterId"
                :chapterId="choice.chapterId"
                :storyId="chapters.data.story.id"
            />
        </div>
        <div v-else-if="choices?.data.choices.length === 0" class="end-container">
            <h2>Vous êtes arrivé a la fin de l'histoire</h2>
            <p>Merci!</p>
            <button @click="end" class="btn btn-primary">Terminer</button>
            <button @click="retry" class="btn btn-secondary">Recommencer</button>
        </div>
    </div>
</template>

<style scoped>
.choices-container {
    margin-top: 2rem;
    padding: 1rem;
}
</style>
