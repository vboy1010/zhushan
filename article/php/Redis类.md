`Redis` 类。

    <?php

    class RedisClient
    {
        private static $config = array(
            'master' => array(
                'host' => '127.0.0.1',
                'port' => 6379,
                'pass' => false,
            ),
            'slave' => array(
                'host' => '127.0.0.1',
                'port' => 6379,
                'pass' => false,
            ),
        );

        private static $methods_run_at_master = array(
            'append', 'decr', 'decrby', 'getset', 'incr', 'incrby', 'incrbyfloat',
            'mset', 'msetnx', 'set', 'setbit', 'setex', 'psetex', 'setnx', 'setrange',
            'del', 'delete', 'expire', 'settimeout', 'pexpire', 'expireat', 'pexpireat',
            'migrate', 'move', 'persist', 'rename', 'renamekey', 'renamenx', 'restore',
            'hdel', 'hincrby', 'hincrby', 'hset', 'hsetnx', 'hmset',
            'blpop', 'brpop', 'brpoplpush', 'linsert', 'lpop', 'lpush', 'lpushx', 'lrem',
            'lremove', 'lset', 'ltrim', 'listtrim', 'rpop', 'rpoplpush', 'rpush', 'rpushx',
            'sadd', 'sdiffstore', 'sinterstore', 'smove', 'spop', 'srem', 'sremove', 'sunionstore',
            'zadd', 'zincrby', 'zinter', 'zrem', 'zdelete', 'zremrangebyrank',
            'zdeleterangebyrank', 'zremrangebyscore', 'zdeleterangebyscore', 'zunion',
        );

        public function setConfig($type, $host, $port = 6379, $pass = false)
        {
            self::$config[$type] = array(
                'host' => $host,
                'port' => $port,
                'pass' => $pass,
            );

            return $this;
        }

        public function setMasterConfig($host, $port = 6379, $pass = false)
        {
            $this->setConfig('master', $host, $port, $pass);

            return $this;
        }

        public function setSlaveConfig($host, $port = 6379, $pass = false)
        {
            $this->setConfig('slave', $host, $port, $pass);

            return $this;
        }

        public function select($type)
        {
            static $instances = array();

            if (isset($instances[$type])) {
                return $instances[$type];
            }

            $config = self::$config[$type];

            $redis = new Redis;
            $redis->connect($config['host'], $config['port']);

            if ($config['pass']) {
                $redis->auth($config['pass']);
            }

            $instances[$type] = $redis;

            return $redis;
        }

        public function __call($method, $arguments)
        {
            if (DEBUG_MODE || PHP_SAPI == 'cli' || in_array(strtolower($method), self::$methods_run_at_master)) {
                $type = 'master';
            } else {
                $type = 'slave';
            }

            $redis = $this->select($type);

            return call_user_func_array(array($redis, $method), $arguments);
        }
}
