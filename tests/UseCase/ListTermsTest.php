<?php

declare(strict_types=1);

namespace Edeans\Tests\UseCase;

use Edeans\Application\AddTerm\AddTerm;
use Edeans\Application\Application;
use Edeans\Application\ListTerms\Term;
use Edeans\Application\ListTerms\TermsList;
use Edeans\Infrastructure\TestServiceContainer;
use PHPUnit\Framework\TestCase;

final class ListTermsTest extends TestCase
{
    private Application $application;

    /**
     * @test
     */
    public function a_hidden_term_does_not_appear_in_the_list(): void
    {
        $termToAdd = new AddTerm();
        $termToAdd->name = 'Term 1';
        $this->application->addTerm($termToAdd);

        $termToAdd = new AddTerm();
        $termToAdd->name = 'Term 2';
        $termId = $this->application->addTerm($termToAdd);

        $this->application->hideTerm($termId);

        $expectedTermsList = new TermsList();
        $term = new Term();
        $term->name = 'Term 1';
        $expectedTermsList->add($term);

        $this->assertEquals($expectedTermsList, $this->application->listTerms());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $container = new TestServiceContainer();
        $this->application = $container->application();
    }
}
