<script setup>
import { onMounted, onUnmounted, ref } from "vue";
import { anchor } from "@/stores/router.js";
import TheNavBar from "@/components/TheNavBar.vue";
import Stories from "../components/pages/Stories.vue";
import Chapter from "../components/pages/Chapter.vue";
let anchorParts = "";
function updateAnchor() {
    anchor.value = window.location.hash.substring(1);
    anchorParts = ref(anchor.value.split("-"));
}
onMounted(() => {
    window.addEventListener("hashchange", updateAnchor);
    updateAnchor();
    console.log("anchor.value", anchor.value);
    if (anchor.value === "") {
        anchor.value = "stories";
    }
    switch (anchor.value) {
        case "stories":
            anchor.value = "stories";
            break;
        case "":
            anchor.value = "stories";
            break;
        default:
            anchor.value = anchor.value;
    }
});
onUnmounted(() => {
    window.removeEventListener("hashchange", updateAnchor);
});
</script>

<template>
    <div class="app">
        <TheNavBar />
        <main class="content">
            <div v-if="anchor === 'stories'">
                <Stories />
            </div>
            <div v-if="anchorParts[1]">
                <div v-if="anchorParts[2]">
                    <Chapter :number="anchorParts[2]" />
                </div>
                <div v-else>
                    <Chapter :number="anchorParts[1]" />
                </div>
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
