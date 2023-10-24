// cypress/support/index.d.ts

declare namespace Cypress {
    interface Chainable {
        /**
         * Custom command to log in through the UI
         * @example cy.login('email@example.com', 'password123')
         */
        login(email: string, password: string): Chainable<any>
    }


}

