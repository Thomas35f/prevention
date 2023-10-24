describe('Footer', () => {
    beforeEach(() => {
        cy.visit('/')
        cy.viewport(1280, 720)
    })

    it('should display the footer', () => {
        cy.get('footer').should('be.visible')
    })

    it('should display the footer title', () => {
        cy.get('footer').contains('Gestion du risque routier en entreprise')
    })

    it('should display the footer contact number', () => {
        cy.get('footer').contains('06 35 19 27 78')
    })

    it('should contain links with correct text', () => {
        cy.get('footer ul li a').contains('À propos')
        cy.get('footer ul li a').contains('Entreprise')
        cy.get('footer ul li a').contains('Presse & Blog')
        cy.get('footer ul li a').contains('Politique de confidentialité')
    })

})
