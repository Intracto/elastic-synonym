<?php

namespace Intracto\ElasticSynonym\Model;

final class Config
{
    /**
     * @param array<int, string> $indices
     */
    public function __construct(
        private string $id,
        private string $name,
        private string $file,
        private array $indices
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @return array<int, string>
     */
    public function getIndices(): array
    {
        return $this->indices;
    }
}