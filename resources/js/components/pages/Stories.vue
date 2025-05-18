<script setup>
import { ref, onMounted } from "vue";
import { useFetchJson } from "@/utils/useFetchJson";
import StoryContainer from "@/components/StoryContainer.vue";

const url = "/api/v1/stories";
const {
    data: stories,
    error: storiesError,
    loading: storiesLoading,
    execute: executeStoriesFetch,
    abort: abortStoriesFetch,
} = useFetchJson({ url: url, immediate: false });

onMounted(() => {
    if (!stories.value) {
        try {
            useFetchJson("/api/v1/stories");
        } catch (e) {
            console.error("Error fetching stories:", e);
        }
    }
});
</script>

<template>
    <div class="stories-page q-pa-md">
        <div class="content-container">
            <h1 class="text-h4 text-center q-mb-md">Bienvenue</h1>
            <p class="text-center q-mb-lg">Voici les histiores disponnibles</p>

            <div v-if="storiesLoading" class="text-center">
                <q-spinner color="primary" size="3em" />
                <div>Loading stories...</div>
            </div>

            <div v-else-if="storiesError" class="text-center text-negative">
                Error loading stories: {{ storiesError.message }}
            </div>

            <div v-else-if="stories?.data" class="stories-container">
                <div class="stories-grid">
                    <StoryContainer
                        v-for="story in stories.data"
                        :key="story.id"
                        :id="story.id"
                        :title="story.title"
                        :summary="story.summary"
                        :author="story.author"
                        class="q-ma-sm"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

.stories-page {
    width: 100%;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    padding: 2rem;
}

.content-container {
    width: 100%;
    max-width: 1200px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.stories-container {
    width: 100%;
    margin-top: 2rem;
    padding: 1rem;
}

.stories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    width: 100%;
    justify-items: center;
}

@media (max-width: 600px) {
    .stories-grid {
        grid-template-columns: 1fr;
    }

    .stories-page {
        padding: 1rem;
    }
}
</style>
