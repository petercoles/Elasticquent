<?php

namespace Elasticquent;

use Elasticquent\Contracts\ElasticquentIndexInterface;

class ElasticquentIndex implements ElasticquentIndexInterface
{
    use ElasticquentClientTrait;

    public function __construct($client = null)
    {
        $this->client = $client ?: new $this->getElasticSearchClient();
    }

    public function exists($index)
    {
        return $this->client->indices()->exists(['index' => $index]);
    }

    public function delete($index)
    {
        return $this->client->indices()->delete(['index' => $index]);
    }

    /**
     * Create Index
     *
     * @param string $index
     * @param int $shards
     * @param int $replicas
     * @param array $analysis
     * @param array $mappings
     *
     * @return array
     */
    public function create($index = null, $shards = null, $replicas = null, $analysis = null, $mappings = null)
    {
        $params['index'] = $this->getIndexName($index);

        if ($shards) {
            $params['body']['settings']['number_of_shards'] = $shards;
        }

        if ($replicas) {
            $params['body']['settings']['number_of_replicas'] = $replicas;
        }

        if ($analysis) {
            $params['body']['settings']['analysis'] = $analysis;   
        }

        if ($mappings) {
            $params['body']['mappings'] = $mappings;   
        }

        return $this->client->indices()->create($params);
    }

    /**
     * Get Index Name
     *
     * @return string
     */
    public function getIndexName($index = null)
    {
        // if we're given an index name, we'll use it
        if ($index) {
            return $index;
        }

        // otherwise we'll see if a default has been specified
        $index = $this->getElasticConfig('default_index');
        if (!empty($index)) {
            return $index;
        }

        // if not, we'll just go with 'default'
        return 'default';
    }
}
