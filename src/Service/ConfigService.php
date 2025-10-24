<?php

namespace Intracto\ElasticSynonym\Service;

use Intracto\ElasticSynonym\Model\Config;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class ConfigService
{
    /** @var array<string, Config> */
    private array $configs = [];
    private bool $validated = false;

    /**
     * @param array<int, array<string, string|array<int, string>>> $rawConfigs
     */
    public function __construct(
        private HttpClientInterface $client,
        array $rawConfigs
    ) {
        foreach ($rawConfigs as $id => $rawConfig) {
            $this->configs[$id] = new Config($id, $rawConfig['name'], $rawConfig['file'], $rawConfig['indices']);
        }
    }

    /**
     * @return array<string, Config>
     */
    public function getConfigs(): array
    {
        if (!$this->validated) {
            $this->validated = true;
            $this->configs = array_filter($this->configs, static function(Config $config): bool {
                return file_exists($config->getFile());
            });
        }

        return $this->configs;
    }

    public function getConfig(string $id): Config
    {
        return $this->configs[$id];
    }

    public function refresh(Config $config): void
    {
        // Combine indices in a single string, so we only have to requests once
        $indices = implode(',', $config->getIndices());

        // Reload search analyzers
        $this->client->request('POST', sprintf('http://localhost:9200/%s/_reload_search_analyzers', $indices));

        // Clear request cache
        $this->client->request('POST', sprintf('http://localhost:9200/%s/_cache/clear?request=true', $indices));
    }
}