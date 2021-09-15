<?php

namespace Intracto\ElasticSynonym\Service;

use Elasticsearch\ClientBuilder;
use Intracto\ElasticSynonym\Model\Config;
use Intracto\ElasticSynonym\Model\Synonym;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class SynonymService
{
    public function getSynonyms(Config $config): array
    {
        dd(file_get_contents($config->getFile()));

        return [
            new Synonym(['fiets', 'loopfiets', 'brommer'], ['fiets', 'loopfiets', 'brommer']),
            new Synonym(['fiets', 'loopfiets', 'brommer'], ['fiets', 'loopfiets', 'brommer']),
            new Synonym(['fiets', 'loopfiets', 'brommer'], ['fiets', 'loopfiets', 'brommer']),
            new Synonym(['fiets', 'loopfiets', 'brommer'], ['fiets', 'loopfiets', 'brommer']),
            new Synonym(['fiets', 'loopfiets', 'brommer'], ['fiets', 'loopfiets', 'brommer']),
        ];
    }

    /**
     * @param Config $config
     * @param array<int, Synonym> $synonyms
     */
    public function setSynonyms(Config $config, array $synonyms): void
    {
//        dd($config, $synonyms);
    }
}