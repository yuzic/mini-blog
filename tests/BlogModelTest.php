<?php
use \App\Model\Blog;

class MoneyTest extends PHPUnit_Framework_TestCase
{

    public function testCount()
    {
        $model = new Blog();
        $this->assertArrayHasKey('count', $model->getCount());
    }

}