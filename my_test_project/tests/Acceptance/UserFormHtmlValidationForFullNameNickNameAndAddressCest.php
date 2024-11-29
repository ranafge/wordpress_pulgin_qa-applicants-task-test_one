<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;
use \Codeception\Step\Argument\PasswordArgument;

class UserFormHtmlValidationForsanitizetionOfFullNameNickNameAndAddressCest
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
    public function UserFormHtmlValidationForFullNameField(AcceptanceTester $I)
    {

        $I->wantToTest("I want to input an HTML '<h1>Samsul</h1>' tag into the 'Full Name' field on the user form and check for a warning 'Full Name consist of only letters and dots.' message for this field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "<h1>Samsul</h1>");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '32');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Full Name consist of only letters and dots.");
        $I->wait(1);
    }


    public function UserFormHtmlValidationForFullNameFieldWithDot(AcceptanceTester $I)
    {
        
        $I->wantToTest("I want to enter a single dot in the 'Full Name' field and verify that no warning message appears by checking for 'Settings saved.' confirmation.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", ".");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '32');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Settings saved.");
    }

    public function UserFormHtmlValidationForFullNameFieldWithASingleCharacter(AcceptanceTester $I)
    {

        $I->wantToTest("I want to enter a single 's' in the 'Full Name' field and verify that no warning message appears by checking 'Settings saved.' confirmation.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.8);
        $I->fillField("input#qa_test_fullname", "s");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '32');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Settings saved.");
    }



    public function UserFormHtmlValidationForNickNameField(AcceptanceTester $I)
    {

        $I->wantToTest("I want to clear the user form data for the nickname field and check that no warning message appears for input '<h1>Rana</h1>' in the nickname field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "<h1>Rana</h1>");
        $I->fillField("input#qa_test_address", "Durgapur");
        $I->fillField("input#qa_test_dob_d", '4');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->dontSee("Nick Name is a required field");
        $I->see("Settings saved.");
    }

    public function UserFormHtmlValidationForAddressField(AcceptanceTester $I)
    {

        $I->wantToTest("I want to clear the user form data for the address field and check that no warning message appears for input '<h1>Address</h1>' in the address field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "<h1>Address</h1>");
        $I->fillField("input#qa_test_dob_d", '4');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->dontSee("Address is a required field");
        $I->see("Settings saved.");
    }


    // javascript


    public function UserFormJavascirptValidationForFullNameField(AcceptanceTester $I)
    {

        $I->wantToTest("I want to put user form data in the full name field with an `<script>alert('XSS')</script>` value and check that no warning message appears and 'Settings saved.' is displayed.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "<script>alert('XSS');</script>");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '32');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->executeJS("window.scrollTo(0, document.body.scrollHeight)");
        $I->click('//input[@type="submit"]');
        $I->See("Settings saved.");
    }

    public function UserFormJavascriptValidationForNickNameField(AcceptanceTester $I)
    {

        $I->wantToTest("I want to clear the user form data for the nickname field and check that no warning message appears for input `<script>alert('XSS')</script>` in the nickname field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "<script>alert('XSS');</script>");
        $I->fillField("input#qa_test_address", "Durgapur");
        $I->fillField("input#qa_test_dob_d", '4');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->dontSee("Nick Name is a required field");
        $I->see("Settings saved.");
    }

    public function UserFormJavascriptValidationForAddressField(AcceptanceTester $I)
    {

        $I->wantToTest("I want to clear the user form data for the address field and check that no warning message appears for '<script>alert('XSS')</script>' in the address field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", " <script>alert('XSS');</script>");
        $I->fillField("input#qa_test_dob_d", '4');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->wait(.3);
        $I->dontSee("Address is a required field");
        $I->see("Settings saved.");
    }
}
