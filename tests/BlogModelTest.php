<?php
use \App\Model\Blog;

class MoneyTest extends PHPUnit_Framework_TestCase
{

    public function testCount()
    {
        $model = new Blog();
        $this->assertArrayHasKey('count', $model->getCount());
    }


    public function testSave()
    {
        $params = [
            'title' => 'title',
            'text' => 'text',
            'image_path' => '/Image/image.jpg',
            'created_at' => time(),
            'modify_at' => time(),
        ];

        $model = new Blog();
        ;
        $this->assertTrue($model->save($params));
    }

}