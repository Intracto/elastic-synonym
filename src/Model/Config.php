<?php

namespace Intracto\ElasticSynonym\Model;

final class Config
{
    private string $id;
    private string $name;
    private string $file;
    /** @var array <int, string> */
    private array $indices;

    public function __construct(string $id, string $name, string $file, array $indices)
    {
        $this->id = $id;
        $this->name = $name;
        $this->file = $file;
        $this->indices = $indices;
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

    public function getIndices(): array
    {
        return $this->indices;
    }
}