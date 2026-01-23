<?php

declare(strict_types=1);

namespace ApiRol\Shared\Infrastructure\Bus\Command;

use Symfony\Component\Messenger\Stamp\HandledStamp;
use ApiRol\Shared\Application\Bus\Command\Command;
use ApiRol\Shared\Application\Bus\Command\CommandBusInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use ApiRol\Shared\Application\Bus\Command\Response;
use ApiRol\Shared\Domain\Service\Assertion\Assert;

final class MessengerCommandBus implements CommandBusInterface
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    public function dispatch(
        Command $command,
    ): void {
        try {
            $stamps = [];
            $this->messageBus->dispatch(Envelope::wrap($command, $stamps));
        } catch (HandlerFailedException $exception) {
            throw current($exception->getWrappedExceptions());
        }
    }

    public function dispatchWithResponse(
        Command $command,
    ): ?Response {
        try {
            $stamps = [];
            $envelope = $this->messageBus->dispatch(Envelope::wrap($command, $stamps));

            /** @var HandledStamp|null $handledStamp */
            $handledStamp = $envelope->last(HandledStamp::class);

            if (!$handledStamp) {
                return null;
            }

            $response = $handledStamp->getResult();

            Assert::isInstanceOf($response, Response::class);

            return $response;
        } catch (HandlerFailedException $exception) {
            throw current($exception->getWrappedExceptions());
            }
        }
}
