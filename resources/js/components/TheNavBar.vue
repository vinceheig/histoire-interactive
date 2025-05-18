<script setup>
function changeAnchor(anchor){
    window.location.hash = `${anchor}`;
}
function changeUrl(page){
    window.location = `${page}`;
}
</script>

<template>
    <nav class="navbar">
        <div class="nav-brand" @click="changeAnchor(`#stories`)">Stories App</div>
        <div class="nav-login" @click="changeUrl(`login`)">
            <button class="login-btn">Log In</button>
        </div>
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
