Feature: character

    @truncateDatabaseTables
    Scenario: It receives a character from a valid request to get character endpoint
        Given I have characters with data
            | id                                   |
            | 68af0ba1-d693-4a8b-8c7a-98e621e8b0ef |
        When I send a "GET" request to "/characters/68af0ba1-d693-4a8b-8c7a-98e621e8b0ef"
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
    Scenario: It creates a character from a valid request to post character endpoint
        When I send a "POST" request to "/characters" with body
      """
      {
        "id": "471d288c-dbe7-4f2f-bfd8-91d9040caed4",
        "characterName": "Test Character",
        "characterDescription": "A character used for testing purposes.",
        "characterLife": 135,
        "characterArmour": 21,
        "characterAttArcanum": 10,
        "characterAttCharisma": 10,
        "characterAttConstitution": 10,
        "characterAttDexterity": 10,
        "characterAttStrength": 10,
        "characterAbilities": [
          {
            "characterAbilityId": "0fa54cda-42c6-42f6-8a1b-0f69364c8db2",
            "abilityId": "5827afb0-033a-4fe4-926e-8aa21bf9318f"
          }
        ]
      }
      """
        Then the response code should be 201
        And I should have the following characters:
            | id                                   |
            | 471d288c-dbe7-4f2f-bfd8-91d9040caed4 |
