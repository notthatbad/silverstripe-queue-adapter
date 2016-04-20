<?php

namespace Ntb\QueueAdapter;
use RedisException;

/**
 * ANotificationMessage queue adapter for redis
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
     * @var \Predis\Client redis object
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
        $this->_redis = new \Predis\Client([
            'scheme' => $server['scheme'],
            'host'   => $server['host'],
            'port'   => $server['port']
        ]);
    }

    /**
     * Publishes a message into the redis queue
     *
     * @param IMessage $msg The message which should be published
     */
    public function publish($msg) {
        $queue = $msg->getTopic();
        $serializedData = QueueHelper::get_serializer()->serialize($msg->getData());
        try {
            $this->_redis->rpush($queue, $serializedData);
        } catch(RedisException $ex) {
            \SS_Log::log("Can't publish data into redis queue.", \SS_Log::ERR);
        }
    }

    /**
     * @param string $queue
     * @return mixed
     */
    public function read($queue) {
        try {
            $serializedData = $this->_redis->lpop($queue);
            return QueueHelper::get_serializer()->deserialize($serializedData);
        } catch(RedisException $ex) {
            \SS_Log::log("Can't read data from redis queue.", \SS_Log::ERR);
        }
        return false;
    }

    /**
     * @param string $queue
     */
    public function clear($queue) {
        $this->_redis->del($queue);
    }

    /**
     * Reads data from a queue and stores the data into a given message. The message will be returned. If an error
     * occurred or no data is provided, the method returns FALSE.
     *
     * @param IMessage $message the message without data
     * @return IMessage|bool the filled message object
     */
    function readInto($message) {
        $queue = $message->getTopic();
        try {
            $serializedData = $this->_redis->lpop($queue);
            $deserialized = QueueHelper::get_serializer()->deserialize($serializedData);
            if($deserialized) {
                $message->setData($deserialized);
                return $message;
            }
        } catch(RedisException $ex) {
            \SS_Log::log("Can't read data from redis queue.", \SS_Log::ERR);
        } catch(\Exception $ex) {
            \SS_Log::log("Can't deserialize the data", \SS_Log::WARN);
        }
        return false;
    }
}
