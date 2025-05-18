<script setup>
import { ref, computed, onMounted, watchEffect } from "vue";
import { useFetchJson } from "@/utils/useFetchJson";
import ChapterContainer from "@/components/ChapterContainer.vue";
import ChoiceContainer from "../ChoiceContainer.vue";
import TheSaveButton from "../TheSaveButton.vue";

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
} = useFetchJson({ url: chapterUrl.value, immediate: true });

// Get current chapter
const currentChapter = computed(() => {
    if (!chapters.value?.data?.chapters) return null;
    return chapters.value.data.chapters.find(
        (chapter) => chapter.number === props.number
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
            const response = await fetch(
                `/api/v1/chapters/${currentChapter.value.id}/choices`
            );
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
};
const retry = () => {
    window.location.hash = `story-${anchor.value[1]}-1`;
};
</script>

<template>
    <div class="chapter-page q-pa-md">
        <div v-if="chaptersLoading" class="text-center">
            <q-spinner color="primary" size="3em" />
            <div>Loading...</div>
        </div>
        
        <div v-else-if="chaptersError" class="text-center">
            Error loading chapters: {{ chaptersError.message }}
        </div>
        
        <div v-else-if="currentChapter" class="content-container">
            <h1 class="text-h4 text-center q-mb-lg">{{ chapters.data.story.title }}</h1>
            
            <ChapterContainer
                :key="currentChapter.id"
                :id="currentChapter.id"
                :content="currentChapter.content"
                :number="currentChapter.number"
                :storyId="currentChapter.storyId"
                class="q-mb-xl"
            />

            <!-- Choices Section -->
            <div v-if="choicesLoading" class="text-center">
                <q-spinner color="primary" size="2em" />
                <div>Loading choices...</div>
            </div>
            
            <div v-else-if="choicesError" class="text-center text-negative">
                Error loading choices: {{ choicesError.message }}
            </div>
            
            <div v-else-if="choices?.data.choices.length > 0" class="choices-container">
                <h2 class="text-h5 text-center q-mb-md">What would you like to do?</h2>
                <div class="choices-grid">
                    <ChoiceContainer
                        v-for="choice in choices.data.choices"
                        :key="choice.id"
                        :id="choice.id"
                        :text="choice.text"
                        :nextChapterId="choice.nextChapterId"
                        :chapterId="choice.chapterId"
                        :storyId="chapters.data.story.id"
                        class="q-ma-sm"
                    />
                </div>
            </div>
            
            <div v-else-if="choices?.data.choices.length === 0" class="end-container text-center q-pa-md">
                <h2 class="text-h5 q-mb-md">Vous êtes arrivé a la fin de l'histoire</h2>
                <p>Merci!</p>
                <div class="row justify-center q-gutter-md">
                    <q-btn color="primary" @click="end" label="Terminer" />
                    <q-btn color="secondary" @click="retry" label="Recommencer" />
                </div>
            </div>
            
            <div class="save-button-container text-center q-mt-lg">
                <TheSaveButton
                    :chapterId="currentChapter.id"
                    :storyId="currentChapter.storyId"
                />
            </div>
        </div>
    </div>
</template>

<style scoped>
.chapter-page {
    width: 100%;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    padding: 2rem;
}

.content-container {
    width: 100%;
    max-width: 800px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.choices-container {
    width: 100%;
    margin-top: 2rem;
    padding: 1rem;
}

.choices-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    width: 100%;
    justify-items: center;
}

@media (max-width: 600px) {
    .choices-grid {
        grid-template-columns: 1fr;
    }
    
    .chapter-page {
        padding: 1rem;
    }
}

.save-button-container {
    position: sticky;
    bottom: 2rem;
    z-index: 1000;
    width: 100%;
}
</style>
