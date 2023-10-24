/// <reference types="cypress" />

Cypress.Commands.add('login', (email, password) => {
    cy.visit('/login')

    // Obtenir le token CSRF
    cy.get('input[name=_token]')
        .should('exist')
        .invoke('val')
        .then(token => {

            cy.request({
                method: 'POST',
                url: '/login',
                form: true,
                body: {
                    email: email,
                    password: password,
                    _token: token
                },
                followRedirect: true
            })
        })
})
