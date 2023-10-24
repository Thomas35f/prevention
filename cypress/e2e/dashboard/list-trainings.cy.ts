// /// <reference types="cypress" />
// describe('ListTrainings', () => {
//     beforeEach(() => {
//         cy.login('maxime.rousseau99@gmail.com', '4rCJ6vZ9m4Yk5p')
//         cy.visit('/dashboard') // Visitez la page où se trouve votre composant.
//         cy.intercept('GET', '/api/trainings', { fixture: 'trainings.json' }).as('getTrainings')
//     })
//
//     it('should display trainings correctly', () => {
//         cy.wait('@getTrainings')
//         cy.get('table.styled-table tbody tr').should('have.length', 6)
//         cy.fixture('trainings.json').then((trainings) => {
//             trainings.forEach((training, index) => {
//                 cy.get(`table.styled-table tbody tr:nth-child(${index + 1})`).within(() => {
//                     cy.get('.col-code').should('have.text', training.seance_code)
//                     cy.get('.col-date').should('have.text', training.date)
//                 })
//             })
//         })
//     })
//
//     it('should highlight a training when clicked', () => {
//         cy.wait('@getTrainings')
//         cy.get('table.styled-table tbody tr:first').click().should('have.class', 'selected')
//     })
//
//     it('should have footer buttons', () => {
//         cy.get('.footer .footer-button').should('have.length', 3)
//     })
// })
//
