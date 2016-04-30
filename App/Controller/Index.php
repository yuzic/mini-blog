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

        try {
            if (Request::post('blog')) {
                $this->saveForm();
            }


        } catch (\Exception $e) {
            $notify['error']  =  $e->getMessage();
        }

        $blogList = [];

        try {
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

        print_r($_POST);

        if ($id  = (int) Request::post('id')) {
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

    public function search()
    {
        $notify = ['error' => null, 'message' => null];
        try {
            $search = Request::post('search');
            $field_name = Request::post('field_name');

            $newsList = (new \App\Model\News)->search($field_name, $search);
        } catch (\Exception $e) {
            $notify['error']  =  $e->getMessage();
        }

        $this->render('index', [
            'newsList' => $newsList,
            'newsCount' => 10,
            'pageCount' =>  100,
            'page' =>  1,
            'notify' => $notify
        ]);
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

            $model  = (new \App\Model\News)->view($id)[0];
        } catch (\Exception $e) {
            $notify['error']  =  $e->getMessage();
        }


        $this->render('view', [
            'news' => $model,
            'notify' => $notify
        ]);

    }

}
