<?php

use Mockery as m;

class RedisQueueTest extends SapphireTest {

    public function testInstantiationOfRedisAdapter() {
        $msg = new FooBarMessage();
        $this->mockPredis($msg);
        $adapter = Ntb\QueueAdapter\QueueHelper::get_queue();
        $adapter->publish($msg);
    }

    /**
     * @param Ntb\QueueAdapter\IMessage $msg
     */
    private function mockPredis($msg=null) {
        $clientMock = m::mock('overload:Predis\Client');
        $clientMock->shouldReceive('rpush')
            ->once()
            ->withArgs([$msg->getTopic(), json_encode($msg->getData())])
            ->andReturn(function() use ($msg) {
                if(!$msg) {
                    throw new RedisException();
                }
            });
    }
}

class FooBarMessage implements TestOnly, Ntb\QueueAdapter\IMessage {

    /**
     * @return array
     */
    function getData() {
        return ["foo" => 1, "bar" => 2];
    }

    /**
     * @return string
     */
    function getTopic() {
        return "foobar";
    }

    /**
     * @param array $data
     */
    function setData($data) {}
}