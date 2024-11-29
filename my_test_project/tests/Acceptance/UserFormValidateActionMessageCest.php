<?php


namespace Tests\Acceptance;

use Codeception\Command\Console;
use Tests\Support\AcceptanceTester;
use \Codeception\Step\Argument\PasswordArgument;
use Codeception\Attribute\Skip;
use Codeception\Attribute\Incomplete;

class UserFormValidateActionMessageCest
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
    public function tryToTestUserFormFieldFullNameAndAddressWarningMessage(AcceptanceTester $I)
    {


        $I->wantToTest("I want to clear the user form input fields and check if warning messages are displayed: 'Full Name is a required field' and 'Address is a required field'.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->executeJS('document.getElementById("qa_test_fullname").value && (document.getElementById("qa_test_fullname").value = "")');
        $I->executeJS('document.getElementById("qa_test_nickname").value && (document.getElementById("qa_test_nickname").value = "")');
        $I->executeJS('document.getElementById("qa_test_address").value && (document.getElementById("qa_test_address").value = "")');
        $I->executeJS('document.getElementById("qa_test_dob_d").value && (document.getElementById("qa_test_dob_d").value = "")');
        $I->executeJS('document.getElementById("qa_test_dob_m").value && (document.getElementById("qa_test_dob_m").value = "")');
        $I->executeJS('document.getElementById("qa_test_dob_y").value && (document.getElementById("qa_test_dob_y").value = "")');
        $I->executeJS('document.getElementById("qa_test_email").value && (document.getElementById("qa_test_email").value = "")');
        $I->executeJS('document.getElementById("qa_test_web").value && (document.getElementById("qa_test_web").value = "")');
        $I->click('//input[@type="submit"]');
        $I->see("Full Name is a required field");
        $I->see("Address is a required field");
    }

    public function tryToTestUserFormFieldFullNameWarningMessage(AcceptanceTester $I)
    {

        $I->wantToTest("I want to clear the user form data in the full name field and check if the warning message 'Full Name is a required field' is displayed.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "");
        $I->fillField("input#qa_test_nickname", "Islam");
        $I->fillField("input#qa_test_address", "Durgapur");
        $I->fillField("input#qa_test_dob_d", '4');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Full Name is a required field");
    }

    public function tryToTestUserFormFieldNickNameWarningMessage(AcceptanceTester $I)
    {

        $I->wantToTest("I want to clear the user form data in the nickname field and check that no warning message for an empty nickname field is displayed and 'Settings saved.' is shown.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "");
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


    public function tryToTestUserFormFieldAddressWarningMessage(AcceptanceTester $I)
    {

        $I->wantToTest("I want to clear the user form data in the address field and check if the warning message 'Address is a required field' is displayed and 'Settings saved.' is not displayed.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "");
        $I->fillField("input#qa_test_dob_d", '4');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Address is a required field");
        $I->dontSee("Settings saved.");
    }

    public function tryToTestUserFormFieldFullNameAcceptEmptyStirnNoWarninggMessage(AcceptanceTester $I)
    {

        $I->wantToTest("I want to clear the user form data in the Full Name and Address fields and check that no warning messages appear for empty string(' ')fields and 'Settings saved.' is displayed.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1);
        $I->fillField("input#qa_test_fullname", " \"\" ");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "\"\"");
        $I->fillField("input#qa_test_dob_d", '4');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->wait(1);
        $I->see("Settings saved.");
    }


    public function tryToTestUserFormFieldFullNameAndAddressTakeASingleCharacterWithNoWarningMessages(AcceptanceTester $I)
    {
        $I->wantToTest("I want to clear the user form data in the Address field with a '.' value and check that no warning message appears for the address field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", ".");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", ".");
        $I->fillField("input#qa_test_dob_d", '4');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->dontSee("Full Name is a required field");
        $I->dontSee("Address is a required field");
        $I->See("Settings saved.");
    }

    public function tryToTestUserFormFieldDateOfBirthDayWarningMessage(AcceptanceTester $I)
    {

        $I->wantToTest("I want to clear the user form data in the Date of Birth day field and check that no warning message appears for the empty Date of Birth day field and 'Settings saved.' is displayed.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->dontSee("Date of Birth Day is a required field");
        $I->see("Settings saved.");
    }

    public function tryToTestUserFormFieldDateOfBirthDayUpperOutOfRangeWarningMessage(AcceptanceTester $I)
    {

        $I->wantToTest("I want to put user form data in the Date of Birth day field with an upper out-of-range value (32) and check that no warning message appears and 'Settings saved.' is displayed.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '32');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->dontSee("any warning.");
        $I->see("Settings saved.");
    }


    public function tryToTestUserFormFieldDateOfBirthDayLowerRangeWarningMessage(AcceptanceTester $I)
    {

        $I->wantToTest("I want to put user form data in the Date of Birth day field with a lower range value (1) and check that no warning message appears and 'Settings saved.' is displayed.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Settings saved.");
    }

    public function tryToTestUserFormFieldDateOfBirthDayInRangeWarningMessage(AcceptanceTester $I)
    {

        $I->wantToTest("I want to put user form data in the Date of Birth day field with a valid range value and check that no warning message appears and 'Settings saved.' is displayed.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '10');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->dontSee("any warning.");
        $I->see("Settings saved.");
    }

    public function tryToTestUserFormFieldDateOfBirthDayInUpperRangeWarningMessage(AcceptanceTester $I)
    {

        $I->wantToTest("I want to put user form data in the Date of Birth day field with an upper range value of '31' and check that no warning message appears, and 'Settings saved.' is displayed.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '31');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->dontSee("any warning.");
        $I->see("Settings saved.");
    }


    public function tryToTestUserFormFieldDateOfBirthDayNonNumericWarningMessage(AcceptanceTester $I)
    {

        $I->wantToTest("I want to put user form data in the Date of Birth day field with a non-numeric value '@' and check that no warning message appears, and 'Settings saved.' is displayed.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '@');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->dontSee("any warning.");
        $I->see("Settings saved.");
    }


    public function tryToTestUserFormFieldDateOfBirthDayFloatValueWarningMessage(AcceptanceTester $I)
    {

        $I->wantToTest("I want to put user form data in the Date of Birth day field with a float value '0.0' and check that no warning message appears, and 'Settings saved.' is displayed.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '0.0');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Settings saved.");
    }


    public function tryToTestUserFormFieldDateOfBirthDayFloatValueTwoValidationWarningMessage(AcceptanceTester $I)
    {


        $I->wantToTest("I want to put user form data in Date of Birth day field with a float value '1.1' and check for warning validation message 'Please enter a valid value. The two nearest valid values are 1 and 2.' for the field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1.1');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $validationMessage = $I->executeJS("return document.getElementById('qa_test_dob_d').validationMessage;");
        $I->assertEquals('Please enter a valid value. The two nearest valid values are 1 and 2.', $validationMessage);
    }

    public function tryToTestUserFormFieldDateOfBirthMonthWarningMessage(AcceptanceTester $I)
    {

        $I->wantToTest("I want to enter user form data with an empty value in the Date of Birth month field and check for no warning.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Settings saved.");
    }


    public function tryToTestUserFormFieldDateOfBirthMonthDefaulOptionchoosevalue(AcceptanceTester $I)
    {

        $I->wantToTest("I want to enter user form data with an empty value in the Date of Birth month field and verify that the default option 'Choose...' is displayed.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $chooseText = $I->grabTextFrom('#qa_test_dob_m option:nth-child(1)');
        $I->assertEquals("Choose...", $chooseText);
    }

    public function tryToTestUserFormFieldDateOfBirthMontFirstMonthJanuary(AcceptanceTester $I)
    {

        $I->wantToTest("I want to select 'January' as the Date of Birth month and verify no warning is shown for the field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "1");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $chooseText = $I->executeJS('return document.querySelector("#qa_test_dob_m").selectedOptions[0].text');
        $I->assertEquals("January", $chooseText);
    }


    public function tryToTestUserFormFieldDateOfBirthMonthThirdMonthMarch(AcceptanceTester $I)
    {

        $I->wantToTest("I want to select 'March' as the Date of Birth month and verify no warning is shown for the field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '4');
        $I->selectOption('select#qa_test_dob_m', "3");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $chooseText = $I->executeJS('return document.querySelector("#qa_test_dob_m").selectedOptions[0].text');
        $I->assertEquals("March", $chooseText);
    }



    public function tryToTestUserFormFieldDateOfBirthMontLastMonthDecember(AcceptanceTester $I)
    {

        $I->wantToTest("I want to put user form data in the Date of Birth month field with December value and check no warning for the field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "12");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $chooseText = $I->executeJS('return document.querySelector("#qa_test_dob_m").selectedOptions[0].text');
        $I->assertEquals("December", $chooseText);
    }


    public function tryToTestUserFormFieldDateOfBirthYearLowerBoundaryRange1990(AcceptanceTester $I)
    {

        $I->wantToTest("I want to put user form data in the Date of Birth year field with a 1900 value and check for a warning message 'Date of Birth Year must be between 1900 and 2017' for the field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "12");  // December
        $I->fillField('input#qa_test_dob_y', "1900");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Date of Birth Year must be between 1900 and 2017");
    }

    public function tryToTestUserFormFieldDateOfBirthYearUpperBoundaryRange2017(AcceptanceTester $I)
    {

        $I->wantToTest("I want to put user form data in the Date of Birth year field with a 2017 value and check for successful form submission with no warning.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "12");  // December
        $I->fillField('input#qa_test_dob_y', "2017");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Settings saved.");
    }


    public function tryToTestUserFormFieldDateOfBirthYearLowerValidRange1901(AcceptanceTester $I)
    {

        $I->wantToTest("I want to put user form data in the Date of Birth year field with a 1901 value and check for the warning message 'Date of Birth Year must be between 1900 and 2017'.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "12");  // December
        $I->fillField('input#qa_test_dob_y', "1901");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Date of Birth Year must be between 1900 and 2017");
    }


    public function tryToTestUserFormFieldDateOfBirthYearUpperValidRange2016(AcceptanceTester $I)
    {

        $I->wantToTest("I want to put user form data in the Date of Birth year field with a 2016 value and check that no warning message appears for the field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "12");  // December
        $I->fillField('input#qa_test_dob_y', "2016");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Settings saved.");
    }


    public function tryToTestUserFormFieldDateOfBirthYearMiddleValidRange2000(AcceptanceTester $I)
    {

        $I->wantToTest("I want to put user form data in the Date of Birth year field with a 2000 value and check that no warning message appears for the field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "12");  // December
        $I->fillField('input#qa_test_dob_y', "2000");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Settings saved.");
    }

    public function tryToTestUserFormFieldDateOfBirthYearLowerValidRange1970(AcceptanceTester $I)
    {;
        $I->wantToTest("I want to put user form data in the Date of Birth year field with a 1970 value and check that no warning message appears for the field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "12");  // December
        $I->fillField('input#qa_test_dob_y', "1970");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->executeJS("window.scrollTo(0, document.body.scrollHeight)");
        $I->wait(3);
        $I->click('//input[@type="submit"]');
        $I->see("Settings saved.");
    }


    public function tryToTestUserFormFieldEmailAddressWarnigMessageForWasiradmindotcom(AcceptanceTester $I)
    {

        $I->wantToTest("I want to put user form data with an invalid email (wasiradmin.com) and check for the warning message 'Email is not valid.' for the field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "12");  // December
        $I->fillField('input#qa_test_dob_y', "1970");
        $I->fillField("input#qa_test_email", 'wasiradmin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->executeJS("window.scrollTo(0, document.body.scrollHeight)");
        $I->wait(1);
        $I->click('//input[@type="submit"]');
        $I->see("Email is not valid.");
    }

    public function tryToTestUserFormFieldEmailAddressWarnigMessageForWasiradmindotexampledotcom(AcceptanceTester $I)
    {

        $I->wantToTest("I want to submit user form data with an invalid email (wasiradmin.example.com) and check for the warning message 'Email is not valid.' for the field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "12");  // December
        $I->fillField('input#qa_test_dob_y', "1970");
        $I->fillField("input#qa_test_email", 'wasiradmin.example.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->executeJS("window.scrollTo(0, document.body.scrollHeight)");
        $I->wait(1);
        $I->click('//input[@type="submit"]');
        $I->see("Email is not valid.");
    }


    public function tryToTestUserFormFieldEmailAddressWarnigMessageForAtWasiradmindotexampledotcom(AcceptanceTester $I)
    {

        $I->wantToTest("I want to submit user form data with an invalid email (@wasiradmin.example.com) and check for the warning message 'Email is not valid.' for the field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "12");  // December
        $I->fillField('input#qa_test_dob_y', "1970");
        $I->fillField("input#qa_test_email", '@wasiradmin.example.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->executeJS("window.scrollTo(0, document.body.scrollHeight)");
        $I->wait(1);
        $I->click('//input[@type="submit"]');
        $I->see("Email is not valid.");
    }

    public function tryToTestUserFormFieldEmailAddressWarnigMessageForwasirSpaceAtWasiradmindotexampledotcom(AcceptanceTester $I)
    {

        $I->wantToTest("I want to submit user form data with an invalid email (wasir@wasiradmin.example.com) and check for the warning message 'Email is not valid.' for the field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "12");  // December
        $I->fillField('input#qa_test_dob_y', "1970");
        $I->fillField("input#qa_test_email", 'wasir @wasiradmin.example.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->executeJS("window.scrollTo(0, document.body.scrollHeight)");
        $I->wait(1);
        $I->click('//input[@type="submit"]');
        $I->see("Email is not valid.");
    }


    public function tryToTestUserFormFieldEmailAddressWarnigMessageForwasirAtSpaceWasiradmindotexampledotcom(AcceptanceTester $I)
    {

        $I->wantToTest("I want to submit user form data with an invalid email (wasir@ wasiradmin.example.com) and check for the warning message 'Email is not valid.' for the field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "12");  // December
        $I->fillField('input#qa_test_dob_y', "1970");
        $I->fillField("input#qa_test_email", 'wasir@ wasiradmin.example.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->executeJS("window.scrollTo(0, document.body.scrollHeight)");
        $I->wait(1);
        $I->click('//input[@type="submit"]');
        $I->see("Email is not valid.");
    }



    // valid format email address
    public function tryToTestUserFormFieldEmailAddressWarnigMessageForuserdotwithdotaverydotverydotlongdotemailataverylongsubdomaindotaverylongdomainnamedotaverylongtlddotcom254character(AcceptanceTester $I)
    {

        $I->wantToTest("I want to submit user form data with a valid email and check that no warning is displayed for the field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(1.5);
        $I->fillField("input#qa_test_fullname", "Samul");
        $I->fillField("input#qa_test_nickname", "Rana");
        $I->fillField("input#qa_test_address", "paik");
        $I->fillField("input#qa_test_dob_d", '1');
        $I->selectOption('select#qa_test_dob_m', "12");  // December
        $I->fillField('input#qa_test_dob_y', "1970");
        $I->fillField("input#qa_test_email", 'user.with.a.very.very.long.email@averylongsubdomain.averylongdomainname.averylongtld.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->executeJS("window.scrollTo(0, document.body.scrollHeight)");
        $I->wait(1);
        $I->click('//input[@type="submit"]');
        $I->see("Settings saved.");
    }


    public function tryToTestUserFormFieldWebAddressWarningMessageForWithoutProtocol(AcceptanceTester $I)
    {

        $I->wantToTest("I want to check the web address field for a value without a protocol and verify the warning message 'Website is not valid.'");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samsul");
        $I->fillField("input#qa_test_nickname", "Islam");
        $I->fillField("input#qa_test_address", "Durgapur");
        $I->fillField("input#qa_test_dob_d", '4');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Website is not valid.");
    }


    public function tryToTestUserFormFieldWebAddressNoWarningForWithProtocol(AcceptanceTester $I)
    {


        $I->wantToTest("I want to check form data web address field and check no warning message for a web address with protocol (https://wasir.com).");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samsul");
        $I->fillField("input#qa_test_nickname", "Islam");
        $I->fillField("input#qa_test_address", "Durgapur");
        $I->fillField("input#qa_test_dob_d", '4');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'https://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Settings saved.");
    }


    public function tryToTestUserFormFieldWebAddressNoWarningForFtpProtocol(AcceptanceTester $I)
    {

        $I->wantToTest("I want to check form data web address field and check no warning message for 'ftp' protocol web address field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samsul");
        $I->fillField("input#qa_test_nickname", "Islam");
        $I->fillField("input#qa_test_address", "Durgapur");
        $I->fillField("input#qa_test_dob_d", '4');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'ftp://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Settings saved.");
    }



    public function tryToTestUserFormFieldWebAddressNoWarningForUnsecuredProtocol(AcceptanceTester $I)
    {
        $I->wantToTest("I want to check form data web address field and check no warning message for unsecured protocol web address field.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samsul");
        $I->fillField("input#qa_test_nickname", "Islam");
        $I->fillField("input#qa_test_address", "Durgapur");
        $I->fillField("input#qa_test_dob_d", '4');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'http://wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Settings saved.");
    }

    public function tryToTestUserFormFieldWebAddressNoWarningForWWWProtocol(AcceptanceTester $I)
    {

        $I->wantToTest("I want to check the form data web address field and verify the warning message 'Website is not valid.' for the web address 'www.//wasir.com'.");
        $I->amOnPage("/wp-admin/options-general.php?page=qa-test-settings");
        $I->wait(.5);
        $I->fillField("input#qa_test_fullname", "Samsul");
        $I->fillField("input#qa_test_nickname", "Islam");
        $I->fillField("input#qa_test_address", "Durgapur");
        $I->fillField("input#qa_test_dob_d", '4');
        $I->selectOption('select#qa_test_dob_m', "7");  // December
        $I->fillField('input#qa_test_dob_y', "2008");
        $I->fillField("input#qa_test_email", 'wasir@admin.com');
        $I->fillField("input#qa_test_web", 'www.//wasir.com');
        $I->click('//input[@type="submit"]');
        $I->see("Website is not valid.");
    }
}
