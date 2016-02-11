<?php
class RedisAdapter implements IQueueAdapter{
  /**
  * @param $msg mixed
  */
  function publish($msg) {
    $redis = new Predis\Client([
        'scheme' => 'tcp',
        'host'   => '10.0.0.1',
        'port'   => 6379,
    ]);

    $queue = $msg->getQueue();
    $serializedData = json_encode($msg->getData());
    $redis->publish($queue, $serializedData);
  }

  /**
  * @param $queue string
  * TODO Implement subscribe method
  */
  function subscribe($queue) {

  }
}
