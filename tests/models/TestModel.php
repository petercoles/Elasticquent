<?php

use Elasticquent\Contracts\ElasticquentModelInterface;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model as Eloquent;

class TestModel extends Eloquent implements ElasticquentModelInterface {

    use ElasticquentTrait;

    protected $table = 'test_table';

    protected $fillable = array('name');
}