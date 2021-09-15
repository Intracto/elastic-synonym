<?php

namespace Intracto\ElasticSynonym\Service;

use Intracto\ElasticSynonym\Model\Config;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class ConfigService
{
    private HttpClientInterface $client;

    /** @var array<string, Config>  */
    private array $configs = [];

    /**
     * @param array <int, array<string, string|array> $rawConfigs
     */
    public function __construct(HttpClientInterface $client, array $rawConfigs)
    {
        $this->client = $client;

        foreach ($rawConfigs as $id => $rawConfig) {
            $this->configs[$id] = new Config($id, $rawConfig['name'], $rawConfig['file'], $rawConfig['indices']);
        }
    }

    public function getConfigs(): array
    {
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