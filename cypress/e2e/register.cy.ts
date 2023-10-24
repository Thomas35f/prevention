/// <reference types="cypress" />
describe('Registration Page', () => {
    beforeEach(() => {
        cy.visit('/register');
    });

    it('should load the page', () => {
        cy.url().should('include', '/register');
    });

    it('should have all the necessary input fields', () => {
        cy.get('input#company_name').should('exist');
        cy.get('input#email').should('exist');
        cy.get('input#phone').should('exist');
        cy.get('input#password').should('exist');
    });

    it('should allow user registration', () => {
        cy.get('input#company_name').type('OpenAI');
        cy.get('input#email').type('test@openai.com', {waitForAnimations: false});
        cy.get('input#phone').type('123456789');
        cy.get('input#password').type('password123');

        cy.get('.btn-register').click();
    });

});
