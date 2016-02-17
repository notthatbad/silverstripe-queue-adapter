<?php

/**
 * Message queue adapter for redis
 * @author Eduard Malyj <eduard.malyj@gmail.com>
 */
class RedisAdapter implements IQueueAdapter{
    /**
     * Default Server Values
     */
    const DEFAULT_HOST = '127.0.0.1';
    const DEFAULT_PORT =  6379;
    const DEFAULT_SCHEME =  'tcp';

    protected $_options = array(
        'host'   => self::DEFAULT_HOST,
        'port'   => self::DEFAULT_PORT,
        'scheme' => self::DEFAULT_SCHEME
    );

    /**
     * Redis object
     *
     * @var Predis\Client redis object
     */
    protected $_redis = null;

    /**
     * Constructor
     *
     * @param array $options associative array of options
     */
    public function __construct(array $options = []) {
        $server = array_merge($options, $this->_options);
        // Create predis object
        $this->_redis = new Predis\Client([
            'scheme' => $server['scheme'],
            'host'   => $server['host'],
            'port'   => $server['port']
        ]);
    }

    /**
     *
     *
     * @param IMessage $msg The message which should be published
     */
    public function publish($msg) {
        $queue = $msg->get_topic();
        $serializedData = QueueHelper::get_serializer()->serialize($msg->get_data());
        if($this->_redis->rpush($queue, $serializedData)) {
            SS_Log::log("Can't publish data into redis queue.", SS_Log::ERR);
        };
    }
}
