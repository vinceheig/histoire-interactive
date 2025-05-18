<script setup>
import { useQuasar } from 'quasar'

const $q = useQuasar()

const load = () => {
    try {
        const saveData = localStorage.getItem("save");
        if (saveData) {
            const { storyId, chapterId } = JSON.parse(saveData);
            window.location.hash = `story-${storyId}-${chapterId}`;
            $q.notify({
                type: 'positive',
                message: 'Partie chargée avec succès!',
                icon: 'check_circle'
            })
        } else {
            throw new Error("Aucune sauvegarde trouvée");
        }
    } catch (error) {
        console.error("Erreur lors du chargement de la partie", error);
        $q.notify({
            type: 'negative',
            message: 'Impossible de charger la partie: ' + error.message,
            icon: 'error'
        })
    }
}
</script>

<template>
    <q-btn
        color="primary"
        icon="cloud_download"
        label="Charger"
        @click="load"
    >
        <q-tooltip>
            Charger une partie sauvegardée
        </q-tooltip>
    </q-btn>
</template>

<style scoped></style>
