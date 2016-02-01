<?php

use Elasticquent\Contracts\ElasticquentModelInterface;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model as Eloquent;

class TestModelWithCustomTypeName extends Eloquent implements ElasticquentModelInterface {

    use ElasticquentTrait;

    protected $table = 'test_table';

    protected $fillable = array('name');

    public function getTypeName()
    {
        return 'test_type_name';
    }
}