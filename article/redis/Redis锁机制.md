<?

class Lock {

    const TIMEOUT = 20;
    const SLEEP = 100000;

    /**
     * Stores the expire time of the currently held lock
     * @var int
     */
    protected static $expire;

    /**
     * Gets a lock or waits for it to become available
     * @param  mixed    $key        Item to lock
     * @param  int      $timeout    Time to wait for the key (seconds)
     * @return mixed    The key
     * @throws LockException If the key is invalid
     * @throws LockTimeoutException If the lock is not acquired before the method times out
     */
    public static function get($key, $timeout = null){
        if(!$key) throw new LockException("Invalid Key");

        $start = time();

        do{
            self::$expire = self::timeout();

            if($acquired = (Redis::setnx("Lock:{$key}", self::$expire))) break;
            if($acquired = (self::recover($key))) break;
            if($timeout === 0) break;

            usleep(self::SLEEP);
        } while(!is_numeric($timeout) || time() < $start + $timout);

        if(!$acquired) throw new LockTimeoutException("Timeout exceeded");

        return $key;
    }

    /**
     * Releases the lock
     * @param  mixed    $key    Item to lock
     * @throws LockException If the key is invalid
     */
    public static function release($key){
        if(!$key) throw new LockException("Invalid Key");

        // Only release the lock if it hasn't expired
        if(self::$expire > time()) Redis::del("Lock:{$key}");
    }

    /**
     * Generates an expire time based on the current time
     * @return int  timeout
     */
    protected static function timeout(){
        return (int) (time() + self::TIMEOUT + 1);
    }

    /**
     * Recover an abandoned lock
     * @param  mixed    $key    Item to lock
     * @return bool Was the lock acquired?
     */
    protected static function recover($key){
        if(($lockTimeout = Redis::get("Lock:{$key}")) > time()) return false;

        $timeout = self::timeout();
        $currentTimeout = Redis::getset("Lock:{$key}", $timeout);

        if($currentTimeout != $lockTimeout) return false;

        self::$expire = $timeout;
        return true;
    }

}

class LockException extends RuntimeException {}
class LockTimeoutException extends LockException {}

//Sample
Lock::get('foo');

$foo = $api->get('foo');
$foo['bar'] = 'baz';
$api->put('foo', $foo);

Lock::release('foo');

?>