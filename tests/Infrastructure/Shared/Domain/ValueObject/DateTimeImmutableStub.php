<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject;

use DateInterval;
use DateTimeImmutable;
use Faker\Factory;

final class DateTimeImmutableStub
{
    public static function yesterday(): DateTimeImmutable
    {
        $now = new DateTimeImmutable();

        return $now->sub(new DateInterval('P1D'));
    }

    public static function monthsAgo($months = 1): DateTimeImmutable
    {
        $now = new DateTimeImmutable();

        return $now->sub(new DateInterval('P' . $months . 'M'));
    }

    public static function weeksAhead($weeks = 1): DateTimeImmutable
    {
        $now = new DateTimeImmutable();

        return $now->add(new DateInterval('P' . $weeks . 'W'));
    }

    public static function now(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }

    public static function random(): DateTimeImmutable
    {
        $faker = Factory::create();

        return DateTimeImmutable::createFromMutable($faker->dateTimeThisYear());
    }

    public static function randomBetween(string $from, string $to): DateTimeImmutable
    {
        $faker = Factory::create();

        return DateTimeImmutable::createFromMutable($faker->dateTimeBetween($from, $to));
    }

    public static function nowWithDateInterval(DateInterval $dateInterval): DateTimeImmutable
    {
        return (new \DateTimeImmutable())->add($dateInterval);
    }
}
