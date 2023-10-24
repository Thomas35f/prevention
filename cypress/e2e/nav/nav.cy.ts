describe('Navigation bar', () => {
    beforeEach(() => {
        cy.visit('/')
        cy.viewport(1280, 720)
    })

    it('should navigate to the home page when the home link is clicked', () => {
        cy.get('ul#navigation li a').contains('Accueil').click()
        cy.url().should('include', '/')
    })

    it('should navigate to the offers page when the offers link is clicked', () => {
        cy.get('ul#navigation li a').contains('Offres').click()
        cy.url().should('include', '/offers')
    })

    it('should navigate to the contact page when the contact link is clicked', () => {
        cy.get('ul#navigation li a').contains('Contact').click()
        cy.url().should('include', '/contact')
    })

    it('should navigate to the login page when the login link is clicked', () => {
        cy.get('ul#navigation li a div.user-icon').trigger('mouseover')
        cy.get('ul#navigation li ul.submenu li a').contains('Connexion').click({ force: true })
        cy.url().should('include', '/login')
    })

    it('should navigate to the register page when the register link is clicked', () => {
        cy.get('ul#navigation li a div.user-icon').trigger('mouseover')
        cy.get('ul#navigation li ul.submenu li a').contains('S\'inscrire').click({ force: true })
        cy.url().should('include', '/register')
    })

})
