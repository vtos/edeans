<?php

declare(strict_types=1);

namespace Edeans\Domain\Model\Term;

class Term
{
    private TermId $id;

    private TermName $name;

    private TemporalStatus $temporalStatus;

    private EnrollingStatus $enrollingStatus;

    private VisibilityStatus $visibilityStatus;

    public function __construct(
        TermId $id,
        TermName $name,
        TemporalStatus $temporalStatus,
        EnrollingStatus $enrollingStatus,
        VisibilityStatus $visibilityStatus
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->temporalStatus = $temporalStatus;
        $this->enrollingStatus = $enrollingStatus;
        $this->visibilityStatus = $visibilityStatus;
    }

    public function hide(): void
    {
        $this->visibilityStatus = VisibilityStatus::hidden();
    }

    public function open(): void
    {
        if ($this->enrollingStatus->isOpen()) {
            throw CouldNotOpenTerm::becauseIsAlreadyOpen();
        }

        $this->enrollingStatus = EnrollingStatus::open();
        $this->temporalStatus = TemporalStatus::current();
    }

    public function close(): void
    {
        if ($this->enrollingStatus->isClosed()) {
            throw CouldNotCloseTerm::becauseIsAlreadyClosed();
        }

        $this->enrollingStatus = EnrollingStatus::closed();
        $this->temporalStatus = TemporalStatus::elapsed();
    }

    public static function withDefaultStatus(TermId $id, TermName $name): self
    {
        return new self($id, $name, TemporalStatus::upcoming(), EnrollingStatus::closed(), VisibilityStatus::visible());
    }
}
