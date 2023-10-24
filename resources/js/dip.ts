class Light {
    turnOn() {
        console.log('Ampoule allumée');
    }

    turnOff() {
        console.log('Ampoule éteinte');
    }
}

class LightSwitch {
    private light: Light;

    constructor() {
        this.light = new Light(); // Création d'une instance concrète d'ampoule
    }

    flip() {
        if (this.light) {
            if (this.light.isTurnedOn()) {
                this.light.turnOff();
            } else {
                this.light.turnOn();
            }
        }
    }
}

const lightSwitch = new LightSwitch();
lightSwitch.flip();
