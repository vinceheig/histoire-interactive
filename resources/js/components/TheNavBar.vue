<script setup>
import TheLoadButton from "./TheLoadButton.vue";
import { useQuasar } from "quasar";
const $q = useQuasar();

function changeAnchor(anchor) {
    window.location.hash = `${anchor}`;
}
function login() {
    //window.location = `${page}`;
    //todo
    $q.notify({
        type: "info",
        message: "Authentification en construction...",
        icon: "error",
    });
}
</script>

<template>
    <nav class="navbar">
        <div class="nav-brand" @click="changeAnchor(`#stories`)">
            Stories App
        </div>
        <TheLoadButton />
        <q-btn
            color="primary"
            icon="account_circle"
            label="login"
            @click="login()"
        >
            <q-tooltip> Login </q-tooltip>
        </q-btn>
    </nav>
</template>

<style scoped>
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    background-color: #f8f9fa;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.nav-brand {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
}

.login-btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    background-color: #007bff;
    color: white;
    cursor: pointer;
    transition: background-color 0.2s;
}

.login-btn:hover {
    background-color: #0056b3;
}
</style>
