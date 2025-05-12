<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Story;
use App\Models\Chapter;
use App\Models\Choice;

class StorySeeder extends Seeder
{
    public function run()
    {
        // 1. Créer l'histoire
        $story = Story::create([
            'title' => 'Station Icarus',
            'summary' => "Tu es technicien·ne de maintenance sur la station spatiale Icarus. Suite à une alerte, tu découvres que la station est en ruine, l’équipage porté disparu, et une créature inconnue a été libérée. Ton but : atteindre la capsule de secours, en choisissant ton chemin avec prudence. Chaque choix peut te rapprocher de la sortie... ou de la mort.",
            'author' => 'Vincent + IA'
        ]);

        // 2. Liste des chapitres
        $chapters = [
            1 => "Tu sors d'un caisson de stase. Sirènes, lumières rouges, l'IA de bord est hors ligne. Tu es seul·e dans le module de sommeil.",
            2 => "Tu accèdes à la salle de commandes, couverte de sang. L'écran de l'IA affiche des fragments corrompus. Une caméra montre une ombre mouvante dans un couloir.",
            3 => "Tu trouves un tournevis, une lampe torche et le journal d'un officier. Il parle d'un \"organisme\" préservé dans le labo.",
            4 => "Le redémarrage prend du temps. Quelque chose gratte à la porte. Tu es désarmé·e.",
            5 => "Le conduit est étroit et sombre. Tu entends un souffle. Un cadavre bloque le passage.",
            6 => "Des cuves sont brisées. L'une contient un cocon vide. Un message vidéo montre un spécimen s’échappant.",
            7 => "Plusieurs corps. Une survivante inconsciente. Les moniteurs indiquent des réactions parasitaires.",
            8 => "Tu retiens ton souffle. La porte s’ouvre lentement. Une forme passe... sans te voir.",
            9 => "Le tunnel d’accès est partiellement dépressurisé. Tu peux accélérer pour le traverser.",
            10 => "Tu rampes en retenant ton souffle. Le corps s'ouvre soudainement, relâchant un parasite mort.",
            11 => "Le scanner détecte des traces thermiques... juste derrière toi. Une fuite s'ouvre.",
            12 => "Tu as réussi à activer les verrous d’une section. Pour l’instant, la créature est bloquée. Une carte d’accès est sur un cadavre.",
            13 => "Tu tentes de l’aider, mais un parasite surgit de sa cage thoracique. Tu es pris·e au piège.",
            14 => "Tu regardes les étoiles, quand un bruit de métal t’interrompt. Tu peux couper les lumières ou te cacher.",
            15 => "L’obscurité t’enveloppe. Des bruits visqueux s’approchent. Tu retiens ton souffle.",
            16 => "Tu cours, l’air se raréfie. Un bras t’agrippe au dernier moment.",
            17 => "Tu arrives devant la salle de la capsule. Elle nécessite deux codes : un trouvé au labo, un autre au centre médical.",
            18 => "La créature surgit. Tu luttes, blessé·e, mais tu sais que tu ne peux pas gagner.",
            19 => "Tu arrives à la capsule, haletant·e. L’accès est libre, mais tu entends un bruit derrière toi...",
            20 => "Tu trouves une combinaison pressurisée et une seringue de sédatif. Des bruits approchent.",
            21 => "Tu enclenches la surcharge du centre médical. Tu regardes les flammes te consumer, mais tu sais que tu as empêché la fuite du monstre.",
            22 => "La capsule se détache. Tu regardes la station disparaître dans l’espace. Tu es sain·e et sauf·saine… sauf si l’Alien était monté à bord.",
            23 => "Tu n’as pas les codes. Tu forces l’entrée, déclenchant un signal de sécurité. La créature surgit.",
            24 => "Tu déclenches l’autodestruction en enfermant la créature avec toi. La station explose.",
            25 => "Tu meurs dans un couloir sombre, comme tant d’autres avant toi.",
            26 => "Tu embarques… mais tu ne sais pas que quelque chose est caché dans ton sac.",
        ];

        // 3. Création des chapitres
        $chapterModels = [];
        foreach ($chapters as $number => $content) {
            $chapterModels[$number] = Chapter::create([
                'number' => $number,
                'content' => $content,
                'storyId' => $story->id
            ]);
        }

        // 4. Définir les choix
        $choices = [
            [1, "Sortir immédiatement du module pour rejoindre la salle de commandes.", 2],
            [1, "Fouiller le module pour trouver un journal de bord ou des outils.", 3],
            [2, "Tenter de relancer l'IA.", 4],
            [2, "Quitter la salle discrètement et emprunter le conduit de maintenance.", 5],
            [3, "Récupérer les objets et aller au labo.", 6],
            [3, "Suivre les consignes de sécurité vers le centre médical.", 7],
            [4, "Te cacher sous la console.", 8],
            [4, "Prendre le risque de sortir par l’issue d’urgence.", 9],
            [5, "Ramper au-dessus du corps.", 10],
            [5, "Revenir en arrière vers un autre accès.", 7],
            [6, "Scanner la salle pour repérer des traces.", 11],
            [6, "Sécuriser l'accès au labo et fuir.", 12],
            [7, "L’aider.", 13],
            [7, "La laisser et partir vers la passerelle d'observation.", 14],
            [8, "Attendre encore.", 15],
            [8, "Sortir et activer les verrous.", 12],
            [9, "Courir à travers.", 16],
            [9, "Retourner en salle de commandes.", 2],
            [10, "Continuer malgré tout.", 17],
            [10, "Revenir en arrière.", 7],
            [11, "Fuir par la trappe d’entretien.", 14],
            [11, "Te battre avec les outils.", 18],
            [12, "Prendre la carte et courir vers la capsule.", 19],
            [12, "Explorer la zone pour trouver du ravitaillement.", 20],
            [13, "Lutter.", 18],
            [13, "Te sacrifier pour faire sauter la salle.", 21],
            [14, "Couper les lumières.", 15],
            [14, "Te cacher dans le caisson d’évacuation.", 19],
            [15, "Activer ta lampe torche.", 18],
            [15, "Te déplacer à l’aveugle.", 19],
            [16, "Lutter.", 18],
            [16, "Utiliser une bonbonne d’oxygène comme propulseur.", 19],
            [17, "Si tu les as, tu entres.", 22],
            [17, "Sinon, tenter de forcer la porte.", 23],
            [18, "Te sacrifier pour activer l’autodestruction.", 24],
            [18, "Mourir dans la lutte.", 25],
            [19, "Fermer la trappe immédiatement.", 22],
            [19, "Vérifier que personne ne te suit.", 26],
            [20, "Utiliser la combinaison.", 19],
            [20, "Utiliser le sédatif sur toi pour ralentir ton rythme vital.", 15],
        ];

        // 5. Création des choix
        foreach ($choices as [$chapterFrom, $text, $chapterTo]) {
            Choice::create([
                'text' => $text,
                'chapterId' => $chapterModels[$chapterFrom]->id,
                'nextChapterId' => $chapterModels[$chapterTo]->id
            ]);
        }
    }
}
