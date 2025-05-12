<script setup>
import { onMounted, onUnmounted, ref } from "vue";
import { anchor } from "@/stores/router.js";
import TheNavBar from "@/components/TheNavBar.vue";
import Stories from "./components/pages/Stories.vue";
import Chapter from "./components/pages/Chapter.vue";
let anchorParts = "";
function updateAnchor(){
    anchor.value = window.location.hash.substring(1);
    anchorParts = ref(anchor.value.split("-"));
}
onMounted(() => {
    window.addEventListener("hashchange", updateAnchor);
    updateAnchor();
    if (anchor.value === "") {
        anchor.value = "stories";
    }
});
onUnmounted(() => {
    window.removeEventListener("hashchange", updateAnchor);
});
</script>

<template>
    <div class="app">
        <TheNavBar />
        {{ anchor }}
        <main class="content">
            <div v-if="anchor === 'stories'">
                <Stories />
            </div>
            <div v-if="anchorParts[0] === 'story'">
                <Chapter />
            </div>
        </main>
    </div>
</template>

<style scoped>
.app {
    min-height: 100vh;
}

.content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
}
</style>
