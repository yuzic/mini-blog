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

        $save = $model->save($params);

        $this->assertObjectHasAttribute('_result', $save);
    }

    public function testUpdateSave()
    {
        $id = (int) $this->getLastId()['id'];

        $params = [
            'title' => 'title',
            'text' => 'text',
            'image_path' => '/Image/image.jpg',
            'modify_at' => time(),
            'id' => $id
        ];

        $model = new Blog();

        $save = $model->update($params);

        $this->assertObjectHasAttribute('_result', $save);
    }

    public function testDelete()
    {
        $id = (int) $this->getLastId()['id'];

        $model = new Blog();

        $delete = $model->delete($id);

        $this->assertEmpty($delete);

    }


    public function getLastId()
    {
        $sql = "SELECT id
                FROM blog
                ORDER BY 1";

        return \Aqua\Db\Connection::query($sql)->asArray()[0];
    }

}