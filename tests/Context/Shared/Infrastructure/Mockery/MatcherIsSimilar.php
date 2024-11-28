<?php

declare(strict_types=1);

namespace SkeletonDDD\Tests\Context\Shared\Infrastructure\Mockery;

use Mockery\Matcher\MatcherInterface;
use SkeletonDDD\Tests\Context\Shared\Infrastructure\PhpUnit\Constraint\ConstraintIsSimilar;
use Stringable;

final readonly class MatcherIsSimilar implements Stringable, MatcherInterface
{
	private ConstraintIsSimilar $constraint;

	public function __construct(mixed $value, float $delta = 0.0)
	{
		$this->constraint = new ConstraintIsSimilar($value, $delta);
	}

	public function match(&$actual): bool
	{
		return $this->constraint->evaluate($actual, '', true);
	}

	public function __toString(): string
	{
		return 'Is similar';
	}
}
