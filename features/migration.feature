Feature: migration
  In order to have a freshly installed persistance layer
  As an UNIX user
  I need to be able to run a migration command to create all the necesary tables
Scenario: Run a migration
  Given I am in the root directory
  When I run "php artisan migrate --no-ansi"
  Then I should get:
    """
    Migrated: 2015_04_21_195843_create_diceware_table
    """