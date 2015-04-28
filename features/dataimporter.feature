Feature: dataimporter
  In order to have a copy of the diceware wordlist
  As a UNIX user
  I need to be able to downlad the diceware word list from the site.
Scenario: Download diceware word list
  Given I am in the root directory
  When I run "php artisan util:importData  --no-ansi"
  Then I should get:
    """
    Getting diceware data
    Retrieved data
    """
  And file should exists "storage/app/diceware.wordlist.asc"