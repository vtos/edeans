<?php

declare(strict_types=1);

namespace Edeans\Tests\Unit\Domain\Model\Term;

use Edeans\Domain\Model\Term\CouldNotCloseTerm;
use Edeans\Domain\Model\Term\CouldNotOpenTerm;
use Edeans\Domain\Model\Term\Term;
use Edeans\Domain\Model\Term\TermId;
use Edeans\Domain\Model\Term\TermName;
use Edeans\Infrastructure\RamseyUuid;
use PHPUnit\Framework\TestCase;

final class TermTest extends TestCase
{
    /**
     * @test
     */
    public function it_fails_to_open_a_term_if_already_opened(): void
    {
        $term = Term::withDefaultStatus(TermId::fromUuid(new RamseyUuid()), TermName::fromString('Term 1'));
        $term->open();

        $this->expectException(CouldNotOpenTerm::class);
        $term->open();
    }

    /**
     * @test
     */
    public function it_fails_to_close_a_term_if_already_closed(): void
    {
        $term = Term::withDefaultStatus(TermId::fromUuid(new RamseyUuid()), TermName::fromString('Term 1'));

        $this->expectException(CouldNotCloseTerm::class);
        $term->close();
    }
}
