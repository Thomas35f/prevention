// /// <reference types="cypress" />
// describe('ListCompanies', () => {
//     beforeEach(() => {
//         cy.login('maxime.rousseau99@gmail.com', '4rCJ6vZ9m4Yk5p')
//         cy.intercept('GET', '/api/companies', { fixture: 'companies.json' }).as('getCompanies')
//         cy.visit('/dashboard') // Visitez la page où se trouve votre composant.
//
//     })
//
//     it('should display companies correctly', () => {
//         cy.wait('@getCompanies')
//         cy.get('table.styled-table tbody tr').should('have.length.gt', 0)
//
//         // Check if the table is not empty
//         cy.get('table.styled-table tbody').then((tableBody) => {
//             if (tableBody.find('tr').length > 0) {
//                 cy.get('table.styled-table tbody tr:first').within(() => {
//                     cy.get('.col-name').should('exist');
//                     cy.get('.col-town').should('exist');
//                     cy.get('.col-address').should('exist');
//                     cy.get('.col-contact').should('exist');
//                 });
//             }
//         })
//     })
//
//     it('should highlight a company when clicked', () => {
//         cy.wait('@getCompanies')
//         cy.get('table.styled-table tbody tr:first').click().should('have.class', 'selected')
//     })
//
//     it('should have footer buttons', () => {
//         cy.get('.footer .footer-button').should('have.length', 3)
//     })
// })
//
//
