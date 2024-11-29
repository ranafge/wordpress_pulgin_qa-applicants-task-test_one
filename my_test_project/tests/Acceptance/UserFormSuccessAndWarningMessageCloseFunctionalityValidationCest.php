<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;
use \Codeception\Step\Argument\PasswordArgument;

class UserFormSuccessAndWarningMessageCloseFunctionalityValidationCest
{

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage("/wp-login.php");
        $I->fillField('//input[@type="text"]', "rana");
        $I->fillField('//input[@type="password"]', new PasswordArgument("Pass1234@"));
        $I->checkOption('#rememberme');
        $I->click('//input[@type="submit"]');
    }

    // tests
    public function tryToTestUserFormSubmissionSuceesMessageCloseFunctionality(AcceptanceTester $I)
    {

        $I->wantToTest("I want to check the functionality of the close button after 'Settings saved.' is displayed.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1);
        $I->fillField("input#qa_test_fullname", "Samsul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '32');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->waitForText("Settings saved.", 1);
        $I->executeJS("document.querySelector('.notice-dismiss').click()");
        $I->wait(.5);
        $I->dontSee("Settings saved.");
    }

    public function tryToTestUserFormSubmissionWarningMessageCloseFunctionalityForTwoMandatoryField(AcceptanceTester $I)
    {

        $I->wantToTest("I want to check the close button functionality for Full Name and Address warning messages.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1);
        $I->fillField("input#qa_test_fullname", "");
        $I->fillField("input#qa_test_nickname", "");
        $I->fillField("input#qa_test_address", "");
        $I->fillField("input#qa_test_dob_d", '');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->executeJS("document.querySelectorAll('button.notice-dismiss').forEach(button=>button.click())");
        $I->waitForElementNotVisible(".notice notice-error settings-error is-dismissible", 5);
        $I->waitForElementNotVisible(".notice notice-error settings-error is-dismissible", 5);
        $I->dontSee("Settings saved.");
    }


    public function tryToTestUserFormSubmissionWarningMessageCloseFunctionalityForFullNameMandatoryField(AcceptanceTester $I)
    {

        $I->wantToTest("I want to check the close button functionality for the Full Name warning message.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1);
        $I->fillField("input#qa_test_fullname", "");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "address");
        $I->fillField("input#qa_test_dob_d", '10');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->executeJS("document.querySelector('button.notice-dismiss').click()");
        $I->waitForElementNotVisible(".notice notice-error settings-error is-dismissible", 5);
        $I->dontSee("Settings saved.");
    }

    public function tryToTestUserFormSubmissionWarningMessageCloseFunctionalityForAddressMandatoryField(AcceptanceTester $I)
    {

        $I->wantToTest("I want to check the close button functionality for the Address warning message.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1);
        $I->fillField("input#qa_test_fullname", "Samsul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "");
        $I->fillField("input#qa_test_dob_d", '10');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->executeJS("document.querySelector('button.notice-dismiss').click()");
        $I->waitForElementNotVisible(".notice notice-error settings-error is-dismissible", 5);
        $I->dontSee("Settings saved.");
    }
}
