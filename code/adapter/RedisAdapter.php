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
   * @var mixed redis object
   */
   protected $_redis = null;

  /**
   * Constructor
   *
   * @param array $options associative array of options
   * @return void
   */
   public function __construct(array $options = array()) {
      $server = array_merge($options, $this->_options);
      // Create predis object
      $this->_redis = new Predis\Client([
          'scheme' => $server['scheme'],
          'host'   => $server['host'],
          'port'   => $server['port']
      ]);
    }

    /**
    * @param $msg mixed
    */
    public function publish($msg) {
        $queue = $msg->get_topic();
        $serializedData = QueueHelper::get_serializer->serialize($msg->get_data());
        $this->_redis->publish($queue, $serializedData);
    }
}
