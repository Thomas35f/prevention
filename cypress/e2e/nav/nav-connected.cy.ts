describe('Navigation bar', () => {
    beforeEach(() => {
        cy.login('maxime.rousseau99@gmail.com', '4rCJ6vZ9m4Yk5p')
        cy.visit('/')
        cy.viewport(1280, 720)
    })

    it('should navigate to the dashboard page when the dashboard link is clicked', () => {
        cy.get('ul#navigation li a').contains('Dashboard').click()
        cy.url().should('include', '/dashboard')
    })

    it('should navigate to the profile page when the profile link is clicked', () => {
        cy.get('ul#navigation li a div.user-icon').trigger('mouseover')
        cy.get('ul#navigation li ul.submenu li a').contains('Profile').click({ force: true })
        cy.url().should('include', '/profile')
    })

    it('should navigate to the logout page when the logout link is clicked', () => {
        cy.get('ul#navigation li a div.user-icon').trigger('mouseover')
        cy.get('ul#navigation li ul.submenu li a').contains('Se déconnecter').click({ force: true })
        cy.url().should('include', '/')
    })
})
