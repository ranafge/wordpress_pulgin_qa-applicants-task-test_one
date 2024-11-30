<?php

namespace Tests\Functional;
use Tests\Support\FunctionalTester;
use \Codeception\Step\Argument\PasswordArgument;

class UserFormSubmissionCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage("/wp-login.php");
        $I->fillField('//input[@type="text"]', "rana");
        $I->fillField('//input[@type="password"]', new PasswordArgument("Pass1234@"));
        $I->checkOption('#rememberme');
        $I->click('//input[@type="submit"]');
        $I->seeResponseCodeIs(200);
    }

    // tests
    public function tryToTestSubmitUserFormDataInDatabase(FunctionalTester $I)
    {
        $I->wantToTest("I want to check if the saved user form data is correctly stored in the database.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->fillField("input#qa_test_fullname", "TestForFullname");
        $I->fillField("input#qa_test_nickname", "TestForNicename");
        $I->fillField("input#qa_test_address", "TestForAddress");
        $I->fillField("input#qa_test_dob_d", '4');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'Test@admin.com');
        $I->fillField("input#qa_test_web", 'https://test.com');
        $I->click('//input[@type="submit"]');
        $I->seeResponseCodeIs(200);
    }

    public function tryToTestUserFormDataFullnameFromDatabase(FunctionalTester $I)
    {

        $I->wantToTest('I want to check if the saved full name data exists in the database.');
        $optionName = 'qa_test_options';
        $optionData = $I->grabFromDatabase('wp_options', 'option_value', ['option_name' => $optionName]);
        $data = unserialize($optionData);
        $I->assertEquals("TestForFullname", $data["qa_test_fullname"], "Full name exists in database");
        codecept_debug($data);
    }

    public function tryToTestUserFormDataNicknameFromDatabase(FunctionalTester $I)
    {
        $I->wantToTest('I want to check if the nickname data is not saved in the database.');
        $optionName = 'qa_test_options';
        $optionData = $I->grabFromDatabase('wp_options', 'option_value', ['option_name' => $optionName]);
        $data = unserialize($optionData);
        $I->assertEmpty("", "Nick name not save in database.");
        codecept_debug($data);
    }

    public function tryToTestUserFormDataAddressFromDatabase(FunctionalTester $I)
    {
        $I->wantToTest('I want to check if the address data is not saved in the database.');
        $optionName = 'qa_test_options';
        $optionData = $I->grabFromDatabase('wp_options', 'option_value', ['option_name' => $optionName]);
        $data = unserialize($optionData);
        $I->assertEmpty("", "Address is not saved in database");
        codecept_debug($data);
    }

    public function tryToTestUserFormDataDateofbirthdayFromDatabase(FunctionalTester $I)
    {
        $I->wantToTest('I want to check if the date of birth data is saved in the database.');
        $optionName = 'qa_test_options';
        $optionData = $I->grabFromDatabase('wp_options', 'option_value', ['option_name' => $optionName]);
        $data = unserialize($optionData);
        $I->assertEquals("4", $data["qa_test_dob_d"]);
        codecept_debug($data);
    }


    public function tryToTestUserFormDataDateofmonthFromDatabase(FunctionalTester $I)
    {
        $I->wantToTest('I want to check if the month of birth data is saved in the database.');
        $optionName = 'qa_test_options';
        $optionData = $I->grabFromDatabase('wp_options', 'option_value', ['option_name' => $optionName]);
        $data = unserialize($optionData);
        $I->assertEquals("7", $data["qa_test_dob_m"]);
        codecept_debug($data);
    }

    public function tryToTestUserFormDataDateofyearFromDatabase(FunctionalTester $I)
    {
        $I->wantToTest('I want to check if the year of birth data is saved in the database.');
        $optionName = 'qa_test_options';
        $optionData = $I->grabFromDatabase('wp_options', 'option_value', ['option_name' => $optionName]);
        $data = unserialize($optionData);
        $I->assertEquals("2008", $data["qa_test_dob_y"]);
    }



    public function tryToTestUserFormDataEmailaddressFromDatabase(FunctionalTester $I)
    {
        $I->wantToTest('I want to check if the email address data is saved in the database.');
        $optionName = 'qa_test_options';
        $optionData = $I->grabFromDatabase('wp_options', 'option_value', ['option_name' => $optionName]);
        $data = unserialize($optionData);
        $I->assertEquals("Test@admin.com", $data["qa_test_email"]);
        codecept_debug($data);
    }

    public function tryToTestUserFormDataWebaddressFromDatabase(FunctionalTester $I)
    {
        $I->wantToTest('I want to check if the website address data is not saved in the database.');
        $optionName = 'qa_test_options';
        $optionData = $I->grabFromDatabase('wp_options', 'option_value', ['option_name' => $optionName]);
        $data = unserialize($optionData);
        $I->assertEmpty("", "Web address is not saved in database.");
    }
}
