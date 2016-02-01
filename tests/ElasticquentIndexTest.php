<?php

use Elasticquent\ElasticquentIndex;
use Mockery as m;

class ElasticquentIndexTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $client = $this->getElasticSearchClient();

        $this->eqIndex = new ElasticquentIndex($client);
    }

    protected function getElasticSearchClient()
    {
        $elasticClient = m::mock('Elasticsearch\Client');

        $elasticClient
            ->shouldReceive('indices')
            ->withNoArgs()
            ->andReturn($elasticClient);

        $elasticClient
            ->shouldReceive('exists')
            ->with(['index' => 'foo'])
            ->andReturn(true);

        $elasticClient
            ->shouldReceive('exists')
            ->with(['index' => 'bar'])
            ->andReturn(false);

        $elasticClient
            ->shouldReceive('delete')
            ->with(['index' => 'foo'])
            ->andReturn(['acknowledged' => true]);

        $elasticClient
            ->shouldReceive('create')
            ->with(['index' => 'my_custom_index_name'])
            ->andReturn(['acknowledged' => true]);

        $elasticClient
            ->shouldReceive('create')
            ->with([
                'index' => 'foo',
                'body' => [
                    'settings' => ['number_of_shards' => 5, 'number_of_replicas' => 2, 'analysis' => 'bar'],
                    'mappings' => 'baz',
                ]
            ])->andReturn(['acknowledged' => true]);

        return $elasticClient; 
    }

    public function testIndexExists()
    {
        $this->assertTrue($this->eqIndex->exists('foo'));
        $this->assertFalse($this->eqIndex->exists('bar'));
    }

    public function testIndexDelete()
    {
        $this->assertEquals(['acknowledged' => true], $this->eqIndex->delete('foo'));
    }

    public function testIndexCreateWithNoParams()
    {
        $this->assertEquals(['acknowledged' => true], $this->eqIndex->create());   
    }

    public function testIndexCreateWithParams()
    {
        $this->assertEquals(['acknowledged' => true], $this->eqIndex->create('foo', 5, 2, 'bar', 'baz'));   
    }
}