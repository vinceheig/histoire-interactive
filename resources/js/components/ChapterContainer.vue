<script setup>
const props = defineProps({
    id: {
        type: Number,
        required: true,
    },
    content: {
        type: String,
        required: true,
    },
    number: {
        type: String,
        required: true,
    },
    storyId: {
        type: String,
        required: true,
    },
});
// function changeUrl(id) {
//     window.location.hash = `story-${props.storyId}-${props.id}`;
// }
</script>

<template>
    <div class="chapter-card">
        <p class="chapter-content">{{ content }}</p>
    </div>
</template>

<style scoped>
.chapter-card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
    margin: 1rem;
    max-width: 400px;
    transition: transform 0.2s ease;
}

.chapter-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}

.chapter-content {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 0.75rem;
}
</style>
