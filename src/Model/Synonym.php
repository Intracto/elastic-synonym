<?php

namespace Intracto\ElasticSynonym\Model;

final class Synonym
{
    /**
     * @param array<int, string> $wordListLeft
     * @param array<int, string> $wordListRight
     */
    public function __construct(
        private array $wordListLeft = [],
        private array $wordListRight = []
    ) {
    }

    /**
     * @return array<int, string>
     */
    public function getWordListLeft(): array
    {
        return $this->wordListLeft;
    }

    /**
     * @param array<int, string> $wordListLeft
     */
    public function setWordListLeft(array $wordListLeft): self
    {
        $this->wordListLeft = $wordListLeft;

        return $this;
    }

    /**
     * @return array<int, string>
     */
    public function getWordListRight(): array
    {
        return $this->wordListRight;
    }

    /**
     * @param array<int, string> $wordListRight
     */
    public function setWordListRight(array $wordListRight): self
    {
        $this->wordListRight = $wordListRight;

        return $this;
    }
}