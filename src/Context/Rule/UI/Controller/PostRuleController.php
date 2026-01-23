<?php

declare(strict_types=1);

namespace ApiRol\Context\Rule\UI\Controller;

use ApiRol\Context\Rule\Application\Command\CreateRule\CreateRuleCommand;
use ApiRol\Context\Rule\Domain\Exception\RuleAlreadyExistsException;
use ApiRol\Shared\UI\Controller\ApiController;
use ApiRol\Shared\UI\Response\ApiHttpErrorResponse;
use ApiRol\Shared\UI\Response\ApiHttpResponse;
use ApiRol\Shared\UI\Response\HttpResponseCode;
use ApiRol\Shared\UI\Response\ResourceCreatedHttpResponse;
use Symfony\Component\HttpFoundation\Request;

final class PostRuleController extends ApiController
{
    public function __invoke(Request $request): ApiHttpResponse
    {
        $data = json_decode($request->getContent(), true);

        $id = $data['id'];

        try {
            $this->dispatch(CreateRuleCommand::create(
                $id,
            ));
        } catch (RuleAlreadyExistsException $exception) {
            return ApiHttpErrorResponse::uniqueError($exception->getMessage(), HttpResponseCode::HTTP_CONFLICT);
        }

        return new ResourceCreatedHttpResponse();
    }
}
