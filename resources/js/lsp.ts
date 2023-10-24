class Bird {
    fly() {
        console.log("L'oiseau vole.");
    }
}

class Ostrich extends Bird {
    // L'autruche ne peut pas voler
}

function makeBirdFly(bird: Bird) {
    bird.fly();
}

const bird = new Bird();
const ostrich = new Ostrich();

makeBirdFly(bird); // Affiche "L'oiseau vole."
makeBirdFly(ostrich); // Erreur à l'exécution, car une autruche ne peut pas voler
