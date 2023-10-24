/// <reference types="cypress" />
describe('Login Page', () => {
    beforeEach(() => {
        cy.visit('/login');
    });

    it('should load the page', () => {
        cy.url().should('include', '/login');
    });

    it('should have all the necessary input fields', () => {
        cy.get('input#email').should('exist');
        cy.get('input#password').should('exist');
    });

    it('should allow user login', () => {
        cy.get('input#email').type('maxime.rousseau99@gmail.com', {waitForAnimations: false});
        cy.get('input#password').type('4rCJ6vZ9m4Yk5p');

        cy.get('.btn-login').click();
    });

});
