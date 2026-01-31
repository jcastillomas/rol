Feature: ability

    @truncateDatabaseTables
    Scenario: It receives a ability from a valid request to get ability endpoint
        Given I have abilities with data
            | id                                   |
            | 68af0ba1-d693-4a8b-8c7a-98e621e8b0ef |
        When I send a "GET" request to "/abilities/68af0ba1-d693-4a8b-8c7a-98e621e8b0ef"
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
    Scenario: It creates a ability from a valid request to post ability endpoint
        When I send a "POST" request to "/abilities" with body
      """
      {
        "id": "471d288c-dbe7-4f2f-bfd8-91d9040caed4",
        "abilityName": "Test Ability",
        "abilityDescription": "A ability used for testing purposes.",
        "abilityLength": 135,
        "abilityTargetKind": 1,
        "abilityValueKind": 1,
        "abilityValue": "2d6"
      }
      """
        Then the response code should be 201
        And I should have the following abilities:
            | id                                   |
            | 471d288c-dbe7-4f2f-bfd8-91d9040caed4 |
