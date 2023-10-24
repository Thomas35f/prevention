/// <reference types="cypress" />
describe('Homepage', () => {

    // Visiter la page d'accueil
    beforeEach(() => {
        cy.visit('/')
    })

    it('should render the title correctly', () => {
        cy.get('.title-home .hero__caption h1').should('contain', 'Gestion du risque ')
    })

    it('should display the login form if user is not logged in', () => {
        // Vérifier que l'utilisateur n'est pas connecté
        cy.window().then((win: Window & typeof globalThis & { localStorage: Storage }) => {
            win.localStorage.removeItem('auth._token.local')
        })


        cy.get('.form-login').should('exist')

    })

    it('should display the services correctly', () => {
        cy.get('#cat-1').should('exist')
        cy.get('#cat-2').should('exist')
        cy.get('#cat-3').should('exist')
    })

})

