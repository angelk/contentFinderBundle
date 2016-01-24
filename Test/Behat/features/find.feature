Feature: search for files

Scenario: search for files
    Given There is file named "myFile" with content "aaa bbb ccc"
    When I search for file having content "bbb"
    Then I should see file "myFile"

Scenario: Search  for file, but it should not be included, because of content
    Given There is file named "myFile" with content "aaa bbb ccc"
    When I search for file having content "ddd"
    Then I should not see file "myFile"