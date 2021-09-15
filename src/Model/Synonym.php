<?php

namespace Intracto\ElasticSynonym\Model;

final class Synonym
{
    private array $wordListLeft = [];
    private array $wordListRight = [];

    public function __construct(array $wordListLeft = [], array $wordListRight = [])
    {
        $this->wordListLeft = $wordListLeft;
        $this->wordListRight = $wordListRight;
    }

    public function getWordListLeft(): array
    {
        return $this->wordListLeft;
    }

    public function setWordListLeft(array $wordListLeft): self
    {
        $this->wordListLeft = $wordListLeft;

        return $this;
    }

    public function getWordListRight(): array
    {
        return $this->wordListRight;
    }

    public function setWordListRight(array $wordListRight): self
    {
        $this->wordListRight = $wordListRight;

        return $this;
    }
}