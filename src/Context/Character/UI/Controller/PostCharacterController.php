<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\UI\Controller;

use ApiRol\Context\Character\Application\Command\CreateCharacter\CreateCharacterCommand;
use ApiRol\Context\Character\Domain\Write\Exception\CharacterAlreadyExistsException;
use ApiRol\Shared\UI\Controller\ApiController;
use ApiRol\Shared\UI\Response\ApiHttpErrorResponse;
use ApiRol\Shared\UI\Response\ApiHttpResponse;
use ApiRol\Shared\UI\Response\HttpResponseCode;
use ApiRol\Shared\UI\Response\ResourceCreatedHttpResponse;
use Symfony\Component\HttpFoundation\Request;

final class PostCharacterController extends ApiController
{
    public function __invoke(Request $request): ApiHttpResponse
    {
        $data = json_decode($request->getContent(), true);

        $id = $data['id'];
        $characterName = $data['characterName'];
        $characterDescription = $data['characterDescription'];
        $characterLife = $data['characterLife'];
        $characterArmour = $data['characterArmour'];
        $characterAttArcanum = $data['characterAttArcanum'];
        $characterAttCharisma = $data['characterAttCharisma'];
        $characterAttConstitution = $data['characterAttConstitution'];
        $characterAttDexterity = $data['characterAttDexterity'];
        $characterAttStrength = $data['characterAttStrength'];
        $characterAbilities = $data['characterAbilities'];

        try {
            $this->dispatch(CreateCharacterCommand::create(
                $id,
                $characterName,
                $characterDescription,
                $characterLife,
                $characterArmour,
                $characterAttArcanum,
                $characterAttCharisma,
                $characterAttConstitution,
                $characterAttDexterity,
                $characterAttStrength,
                $characterAbilities
            ));
        } catch (CharacterAlreadyExistsException $exception) {
            return ApiHttpErrorResponse::uniqueError($exception->getMessage(), HttpResponseCode::HTTP_CONFLICT);
        }

        return new ResourceCreatedHttpResponse();
    }
}
