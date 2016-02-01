<?php

namespace Elasticquent\Contracts;

interface ElasticquentIndexInterface
{
    /**
     * Get ElasticSearch Client
     *
     * @return Elasticsearch\Client
     */
    public function getElasticSearchClient();

    /**
     * Create a new index
     *
     * @return boolean
     */
    public function exists($index);

    /**
     * Check if index exists
     *
     * @return ?
     */
    public function delete($index);

    /**
     * Delete index
     *
     * @return ?
     */
    public function create($index = null, $shards = null, $replicas = null, $analysis = null, $mappings = null);
}
