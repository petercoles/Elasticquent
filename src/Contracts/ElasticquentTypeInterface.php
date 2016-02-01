<?php

namespace Elasticquent\Contracts;

interface ElasticquentTypeInterface
{
    /**
     * Get Mapping Properties
     *
     * @return array
     */
    public function getMappingProperties();

    /**
     * Set Mapping Properties
     *
     * @param   array $mapping
     */
    public function setMappingProperties(array $mapping = null);

    /**
     * Get Basic Elasticsearch Params
     *
     * Most Elasticsearch API calls need the index and
     * type passed in a parameter array.
     *
     * @param bool $getIdIfPossible
     *
     * @return array
     */
    public function getBasicEsParams($getIdIfPossible = true);

    /**
     * Put Mapping.
     *
     * @param bool $ignoreConflicts
     *
     * @return
     */
    public static function putMapping($ignoreConflicts = false);

    /**
     * Delete Mapping
     *
     * @return
     */
    public static function deleteMapping();

    /**
     * Rebuild Mapping
     *
     * This will delete and then re-add
     * the mapping for this model.
     *
     * @return
     */
    public static function rebuildMapping();

    /**
     * Get Mapping
     *
     * Get our existing Elasticsearch mapping
     * for this model.
     *
     * @return
     */
    public static function getMapping();

    /**
     * Type Exists
     *
     * Does this type exist?
     *
     * @return bool
     */
    public static function typeExists();
}
