<?php

use Elasticquent\Contracts\ElasticquentModelInterface;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model as Eloquent;

class CustomTestModel extends Eloquent implements ElasticquentModelInterface {

    use ElasticquentTrait;

    protected $fillable = array('name');

    function getIndexDocumentData()
    {
        return array('foo' => 'bar');
    }
}
