/// <reference types="cypress" />
describe('Offers page', () => {
    beforeEach(() => {

        cy.visit('/offers')
        cy.viewport(1280, 720)
    })

    it('should display the title of the offers page', () => {
        cy.get('.title-offers').contains('Nos offres disponible')
    })

    it('should display the name of the first offer in the gallery', () => {
        cy.get('.gallery-nav button:nth-child(1) span').contains('Plus')
    })

    it('should display the name of the second offer in the gallery', () => {
        cy.get('.gallery-nav button:nth-child(2) span').contains('Business')
    })

    it('should display the name of the third offer in the gallery', () => {
        cy.get('.gallery-nav button:nth-child(3) span').contains('Enterprise')
    })

})
