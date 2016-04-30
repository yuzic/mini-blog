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
        $config = \Aqua\Aqua::getConfig();

        try {
            self::$_instance = new \PDO($config['dsn'], $config['user'], $config['password']);
        }
        catch (\Exception $e) {
            die ("BD connect error!: " . $e->getMessage() . "<br/>");
        }

        return self::instance ();
    }

    /**
     * For qeury
     * @param $query
     * @param array $params
     * @return \Result
     */
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
