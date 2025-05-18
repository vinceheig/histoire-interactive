<script setup>
import { useQuasar } from 'quasar'

const $q = useQuasar()

const props = defineProps({
    storyId: {
        type: String,
        required: true,
    },
    chapterId: {
        type: Number,
        required: true,
    },
});

const save = () => {
    try {
        if(props.storyId && props.chapterId) {
            localStorage.setItem("save", JSON.stringify({
                "storyId": props.storyId,
                "chapterId": props.chapterId,
            }));
            $q.notify({
                type: 'positive',
                message: 'Partie sauvegardée avec succès!',
                icon: 'save'
            })
        } else {
            throw new Error("Les données de sauvegarde sont manquantes");
        }
    } catch (error) {
        console.error("Erreur lors de la sauvegarde de la partie", error);
        $q.notify({
            type: 'negative',
            message: 'Impossible de sauvegarder la partie: ' + error.message,
            icon: 'error'
        })
    }
};
</script>

<template>
    <q-btn
        color="primary"
        icon="save"
        label="Sauvegarder"
        @click="save"
    >
        <q-tooltip>
            Sauvegarder votre progression
        </q-tooltip>
    </q-btn>
</template>

<style scoped></style>
