<?php
namespace Aqua\Db;

class Connection
{
    protected static $_instance = null;

    /**
     * @return \PDO
     */
    public static function instance ()
    {
        if (self::$_instance) {
            return self::$_instance;
        }

        $config = \Aqua\Base\Config\Manager::get('db');

        extract ($config);
      //  $connection_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
        try {
            self::$_instance = new \PDO("mysql:host={$host};dbname={$dbname}", $user, $password);
        }
        catch (\Exception $e) {
            die ("BD connect error!: " . $e->getMessage() . "<br/>");
        }

        return self::instance ();
    }


    public static function query ($query, $params = [])
    {
        try {
            $result = self::instance ()->prepare($query);

            $result->execute($params);

            if (!$result){
                print_r(debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1));
            }

        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }

       return new Result ($result);
    }
}
