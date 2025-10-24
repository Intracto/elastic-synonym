<?php

namespace Intracto\ElasticSynonym\Service;

use Intracto\ElasticSynonym\Model\Config;
use Intracto\ElasticSynonym\Model\Synonym;

final class SynonymService
{
    /**
     * @return array<int, Synonym>
     */
    public function getSynonyms(Config $config): array
    {
        $synonyms = [];

        $file = new \SplFileObject($config->getFile(), 'r') ;
        foreach ($file as $line) {
            if ('' === $line) {
                continue;
            }

            $parts = array_pad(array_map('trim', explode('=>', $line)), 2, '');

            $left = array_map('trim', explode(',', $parts[0]));
            $right = array_map('trim', explode(',', $parts[1]));

            // transform implicit to explicit synonyms
            if (count($left) && !count($right)) {
                $right = $left;
            }

            $synonyms[] = new Synonym($left, $right);
        }

        return $synonyms;
    }

    /**
     * @param Config $config
     * @param array<int, Synonym> $synonyms
     */
    public function setSynonyms(Config $config, array $synonyms): void
    {
        $file = new \SplFileObject($config->getFile(), 'w') ;
        foreach ($synonyms as $synonym) {
            $file->fwrite(sprintf('%s => %s', implode(', ', $synonym->getWordListLeft()), implode(', ', $synonym->getWordListRight())).PHP_EOL);
        }
    }
}