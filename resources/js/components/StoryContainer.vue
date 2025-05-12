<script setup>
defineProps({
    id: {
        type: Number,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    summary: {
        type: String,
        required: true,
    },
    author: {
        type: String,
        required: true,
    },
});
function changeUrl(id) {
    window.location.hash = `story-${id}`;
}
</script>

<template>
    <div class="story-card" @click="changeUrl(id)">
        <h2 class="story-title">{{ title }}</h2>
        <p class="story-summary">{{ summary }}</p>
        <p class="story-author">Par {{ author }}</p>
    </div>
</template>

<style scoped>
.story-card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
    margin: 1rem;
    max-width: 400px;
    transition: transform 0.2s ease;
}

.story-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}

.story-title {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 0.75rem;
}

.story-summary {
    color: #666;
    margin-bottom: 1rem;
    line-height: 1.5;
}

.story-author {
    color: #888;
    font-style: italic;
    font-size: 0.9rem;
    margin: 0;
}
</style>
