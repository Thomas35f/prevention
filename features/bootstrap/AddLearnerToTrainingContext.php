<?php

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;

class AddLearnerToTrainingContext extends MinkContext implements Context
{
    /**
     * @Given /^je suis connecté en tant que formateur$/
     */
    public function queJeSuisConnecteEnTantQueFormateur()
    {
        $this->visit('/login');
        $this->fillField('email', 'maxime.rousseau99@gmail.com');
        $this->fillField('password', '4rCJ6vZ9m4Yk5p');
        $this->pressButton('Se connecter');
        $this->assertSession()->addressEquals('/dashboard');
    }

    /**
     * @Given /^je suis sur la page de la formation$/
     */
    public function queJeSuisSurLaPageDeLaFormation()
    {
    }

    /**
     * @When /^je clique sur "([^"]*)" à côté de la formation$/
     */
    public function jeCliqueSurACoteDeLaFormation($arg1)
    {
    }

    /**
     * @Given /^j'ai les droits pour ajouter un stagiaire$/
     */
    public function queJaiLesDroitsPourAjouterUnStagiaire()
    {
    }

    /**
     * @Then /^un formulaire doit apparaître pour ajouter un stagiaire$/
     */
    public function unFormulaireDoitApparaitrePourAjouterUnStagiaire()
    {
    }
}
