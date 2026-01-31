<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\UI\Controller;

use ApiRol\Context\Character\Application\Command\CreateAbility\CreateAbilityCommand;
use ApiRol\Context\Character\Domain\Write\Exception\AbilityAlreadyExistsException;
use ApiRol\Shared\UI\Controller\ApiController;
use ApiRol\Shared\UI\Response\ApiHttpErrorResponse;
use ApiRol\Shared\UI\Response\ApiHttpResponse;
use ApiRol\Shared\UI\Response\HttpResponseCode;
use ApiRol\Shared\UI\Response\ResourceCreatedHttpResponse;
use Symfony\Component\HttpFoundation\Request;

final class PostAbilityController extends ApiController
{
    public function __invoke(Request $request): ApiHttpResponse
    {
        $data = json_decode($request->getContent(), true);

        $id = $data['id'];
        $abilityName = $data['abilityName'];
        $abilityDescription = $data['abilityDescription'];
        $abilityLength = $data['abilityLength'];
        $abilityTargetKind = $data['abilityTargetKind'];
        $abilityValueKind = $data['abilityValueKind'];
        $abilityValue = $data['abilityValue'];

        try {
            $this->dispatch(CreateAbilityCommand::create(
                $id,
                $abilityName,
                $abilityDescription,
                $abilityLength,
                $abilityTargetKind,
                $abilityValueKind,
                $abilityValue
            ));
        } catch (AbilityAlreadyExistsException $exception) {
            return ApiHttpErrorResponse::uniqueError($exception->getMessage(), HttpResponseCode::HTTP_CONFLICT);
        }

        return new ResourceCreatedHttpResponse();
    }
}
