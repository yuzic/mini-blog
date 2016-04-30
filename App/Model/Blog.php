<?php
namespace App\Model;

class Blog extends \Aqua\Db\Model
{
    /**
     * messages on page
     */
    const PAGE_COUNT = 3;

    public $sortListAllow = [
        'title',
        'created_at',
    ];

    public $orderListAllow = [
        'DESC',
        'ASC',
    ];

    /**
     * Get list comment
     * @param $page - page id
     * @param string $field
     * @param string $order
     * @return array
     * @throws \Exception
     */
    public function postList($page, $field = 'created_at', $order = 'DESC')
    {
        $orderSql = $field . ' ' . strtolower($order);

        $query = 'SELECT
                    *
                FROM blog
                ORDER BY ' .$orderSql.'
                LIMIT '.self::PAGE_COUNT.'
                OFFSET '. $this->getOffset($page) .'
                ';


        return  \Aqua\Db\Connection::query($query)->asArray();
    }

    /**
     * Get One record
     * @param $id
     * @return array
     */
    public function getOne($id)
    {
        $query = 'SELECT
                   *
                FROM blog
                WHERE id=:id
                ';

        return  \Aqua\Db\Connection::query($query, [
            'id' => $id,
        ])->asArray();
    }

    public function save(array $params)
    {
        $query = 'INSERT INTO blog
                (
                  title,
                  text,
                  image_path,
                  created_at,
                  modify_at
                )
                VALUES
                (
                  :title,
                  :text,
                  :image_path,
                  :created_at,
                  :modify_at
                )';

        return  \Aqua\Db\Connection::query($query, $params);
    }

    public function update(array $params)
    {
        $query = 'UPDATE blog
                  SET   title=:title,
                        text=:text,
                        image_path=:image_path,
                        modify_at=:modify_at
                  WHERE id=:id';

        return  \Aqua\Db\Connection::query($query, $params);
    }

    public function getCount()
    {
        $sql = "SELECT count(1) as `count`
                FROM blog";

        return \Aqua\Db\Connection::query($sql)->asArray()[0];
    }


    protected function getOffset($page)
    {
        $page = ($page <=0) ? 1: $page;

        return  (self::PAGE_COUNT * ($page - 1));
    }

    /**
     * Get One record
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        $query = 'DELETE FROM blog WHERE id=:id';

        return  \Aqua\Db\Connection::query($query, [
            'id' => $id,
        ]);
    }


  }
