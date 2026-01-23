Feature: rule

    @truncateDatabaseTables
    Scenario: It receives a rule from a valid request to get rule endpoint
        Given I have rules with data
            | id                                   |
            | 68af0ba1-d693-4a8b-8c7a-98e621e8b0ef |
        When I send a "GET" request to "/rules/68af0ba1-d693-4a8b-8c7a-98e621e8b0ef"
        Then the response code should be 200
        And the response body should be:
    """
    {
      "data": {
        "id" : "68af0ba1-d693-4a8b-8c7a-98e621e8b0ef"
        },
      "metadata": []
    }
    """

    @truncateDatabaseTables @purgeQueues
    Scenario: It creates a rule from a valid request to post rule endpoint with role CUSTOMER
        When I send a "POST" request to "/rules" with body
      """
      {
        "id": "68af0ba1-d693-4a8b-8c7a-98e621e8b0ef"
      }
      """
        Then the response code should be 201
        And I should have the following rules:
            | id                                   |
            | 68af0ba1-d693-4a8b-8c7a-98e621e8b0ef |
