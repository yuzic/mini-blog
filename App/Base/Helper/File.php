<?php
namespace App\Base\Helper;
/**
 * Created by PhpStorm.
 * User: itcoder
 * Date: 30.04.16
 * Time: 12:45
 */
class File
{
    /**
     * Path for upload
     * @var null
     */
    public $path = null;

    /**
     * Allow upload type
     * @var array
     */
    public $allowType =  [
        'jpg',
        'jpeg',
        'png',
        'gif'
    ];

    public static function getExtension($fileName)
    {
        $exp = explode(".", $fileName);
        $end =  end($exp);

        return $end;
    }

    public static function getDocumenRoot()
    {
        return $_SERVER['DOCUMENT_ROOT'];
    }

    public static function isAllowUpload($fileName)
    {
        $extFile = self::getExtension($fileName);
        if (array_key_exists($extFile , self::$allowType)){
            return true;
        }

        return false;
    }


    public static function upload($path)
    {

        $md5Key = md5(uniqid());
        $filePathUpload = self::getDocumenRoot(). '/'. $path . '/';
        $fileName = $_FILES['image_path']['name'];
        $ext = self::getExtension($fileName);
        $fileNameUpload = $md5Key.'.'.$ext;
        if (move_uploaded_file($_FILES['image_path']['tmp_name'], $filePathUpload . $fileNameUpload )) {
            return [
                'path' => $path . '/',
                'name' => $fileNameUpload
            ];
        }

        echo 'Error down load photo';
        return false;


    }

    public static function delete($path, $fileName)
    {
        return unlink(self::getDocumenRoot().'/'.$path.$fileName);
    }
}