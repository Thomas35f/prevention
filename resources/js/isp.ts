interface Vehicle {
    drive(): void;
    fly(): void;
}

class Car implements Vehicle {
    drive() {
        // Logique de conduite pour la voiture
    }

    fly() {
        // Logique de vol fictive pour la voiture
    }
}

class Airplane implements Vehicle {
    drive() {
        // Logique de conduite pour l'avion
    }

    fly() {
        // Logique de vol pour l'avion
    }
}
