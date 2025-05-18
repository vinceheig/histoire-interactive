<script setup>
const props = defineProps({
    id: {
        type: Number,
        required: true,
    },
    text: {
        type: String,
        required: true,
    },
    nextChapterId: {
        type: String,
        required: true,
    },
    chapterId: {
        type: String,
        required: true,
    },
    storyId: {
        type: Number,
        required: true,
    },
});
function changeUrl(id) {
    window.location.hash = `story-${props.storyId}-${id}`;
}
</script>

<template>
    <div class="choice-card" @click="changeUrl(props.nextChapterId)">
        <p class="choice-text">{{ props.text }}</p>
    </div>
</template>

<style scoped>
.choice-card {
    background-color: blue;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
    margin: 1rem;
    max-width: 400px;
    transition: transform 0.2s ease;
}

.choice-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}

.choice-text {
    font-size: 1.5rem;
    color: white;
    margin-bottom: 0.75rem;
}
</style>
