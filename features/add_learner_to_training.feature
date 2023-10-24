# language: fr
Fonctionnalité: Ajouter un stagiaire à une formation

    Scénario: Formateur ajoute un nouveau stagiaire
        Étant donné que je suis connecté en tant que formateur
        Et que je suis sur la page de la formation
        Quand je clique sur "+" à côté de la formation
        Et que j'ai les droits pour ajouter un stagiaire
        Alors un formulaire doit apparaître pour ajouter un stagiaire
