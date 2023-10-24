/// <reference types="cypress" />
describe('Contact page', () => {
    beforeEach(() => {
        cy.visit('/contact')
        cy.viewport(1280, 720)
    })

    it('should display the title of the contact page', () => {
        cy.get('.hero-cap h2').contains('Contactez Nous')
    })

    it('should display the "Home" breadcrumb link', () => {
        cy.get('.breadcrumb li:nth-child(1) a').contains('Accueil')
    })

    it('should display the "Contact" breadcrumb link', () => {
        cy.get('.breadcrumb li:nth-child(2) a').contains('Contact')
    })

    it('should display the contact form with the correct fields', () => {
        cy.get('#subject').should('have.attr', 'placeholder', 'Objet')
        cy.get('#message').should('have.attr', 'placeholder', 'Message')
        cy.get('#name').should('have.attr', 'placeholder', 'Nom')
        cy.get('#email').should('have.attr', 'placeholder', 'Email')
    })

})
