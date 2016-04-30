<?php
namespace App\Controller;

use \Aqua\Base\Request;
use \App\Base\Helper\File;

class Index extends \Aqua\Base\Controller
{

    public function index($page = 1)
    {
        $page = (int) $page;
        $sortField =  Request::get('field', 'created_at');
        $orderMethod  = strtoupper(Request::get('order', 'desc'));
        $notify = ['error' => null, 'message' => null];
        $blog =  new \App\Model\Blog;

        $blogList = [];
        try {

            if (Request::post('blog')) {
                $this->saveForm();
            }

            if (!in_array($sortField, $blog->sortListAllow)) {
                throw new \Exception('Error validate field');
            }

            if (!in_array($orderMethod, $blog->orderListAllow)) {
                throw new \Exception('Error validate order parametr');
            }

            $blogList = $blog->postList($page, $sortField, $orderMethod);

        } catch (\Exception $e) {
            $notify['error']  =  $e->getMessage();
        }

        $this->render('index', [
            'newsList' => $blogList,
            'newsCount' => $blog->getCount()['count'],
            'pageCount' =>  \App\Model\Blog::PAGE_COUNT,
            'page' =>  $page,
            'notify' => $notify
        ]);
    }


    public function saveForm()
    {
        $title = Request::post('title');
        $text = Request::post('text');

        $blog =  new \App\Model\Blog;

        if (empty($title)) {
            throw new \Exception('Empty title');
        }

        if (empty($text)) {
            throw new \Exception('Empty text');
        }

        $image = File::upload('Image','new_image');

        if (empty($image)) {
            throw new \Exception('Empty Image');
        }


        $params = [
            'title' => $title,
            'text' => $text,
            'image_path' => $image['path'] . $image['name'],
            'created_at' => time(),
            'modify_at' => time(),
        ];

        if ($id  = (int) Request::post('id')) {
            unset($params['created_at']);
            $params['id'] = $id;
            $blog->update($params);
        } else {

            if (!$blog->save($params)) {
                throw new \Exception('Error save news');
            }
        }

        $notify['message'] = 'Post success add';

        unset($_POST);
    }


    public function delete($id = 1)
    {
        $id = (int) $id;
        $notify = ['error' => null, 'message' => null];
        try {

            if (!$id) {
                throw new \Exception('Error get id post');
            }
            $blog = new \App\Model\Blog;
            $model  = $blog->getOne($id)[0];

            if (!isset($model['id'])) {
                throw new \Exception('Is is not exist');
            }

            $delete  = $blog->delete($id);

            if(!$delete) {
                throw new \Exception('Cant\'t Delete post');
            }

            if(!File::delete($model['image_path'])) {
                throw new \Exception('Cant\'t Delete file');
            }

            header('Location: /');
            exit;


        } catch (\Exception $e) {
            $notify['error']  =  $e->getMessage();
        }

    }

    public function edit($id = 1)
    {
        $id = (int) $id;
        $notify = ['error' => null, 'message' => null];
        try {
            if (Request::post('blog')) {
                $this->saveForm();
            }

            if (!$id) {
                throw new \Exception('Error get id post');
            }

            $model  = (new \App\Model\Blog)->getOne($id)[0];

            Request::setPost('title', $model['title']);
            Request::setPost('image_path', $model['image_path']);
            Request::setPost('text', $model['text']);
        } catch (\Exception $e) {
            $notify['error']  =  $e->getMessage();
        }

        $this->render('form', [
            'post' => $model,
            'update' => 1,
            'notify' => $notify
        ]);

    }

    public function view($id = 1)
    {
        $id = (int) $id;
        $notify = ['error' => null, 'message' => null];
        try {
            if (!$id) {
                throw new \Exception('Error get id new');
            }

            $model  = (new \App\Model\Blog)->getOne($id)[0];
        } catch (\Exception $e) {
            $notify['error']  =  $e->getMessage();
        }

        $this->render('view', [
            'blog' => $model,
            'notify' => $notify
        ]);

    }

}
