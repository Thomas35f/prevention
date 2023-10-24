class Shape {
    type: string;

    constructor(type: string) {
        this.type = type;
    }

    area() {
        if (this.type === "circle") {
            // Calcul de l'aire du cercle
        } else if (this.type === "square") {
            // Calcul de l'aire du carré
        }
        // Ajouter un autre bloc "if" pour chaque nouvelle forme
    }
}

const circle = new Shape("circle");
const square = new Shape("square");

console.log(circle.area());
console.log(square.area());
