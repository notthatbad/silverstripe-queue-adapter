<?php

use Mockery as m;

class RedisQueueTest extends SapphireTest {

    public function testInstantiationOfRedisAdapter() {
        $msg = new FooBarMessage();
        $this->mockPredis($msg);
        $adapter = QueueHelper::get_queue();
        $adapter->publish($msg);
    }

    /**
     * @param IMessage $msg
     */
    private function mockPredis($msg=null) {
        $clientMock = m::mock('overload:Predis\Client');
        $clientMock->shouldReceive('rpush')
            ->once()
            ->withArgs([$msg->get_topic(), json_encode($msg->get_data())])
            ->andReturn(function() use ($msg) {
                if(!$msg) {
                    throw new RedisException();
                }
            });
    }
}

class FooBarMessage implements TestOnly, IMessage {

    /**
     * @return array
     */
    function get_data() {
        return ["foo" => 1, "bar" => 2];
    }

    /**
     * @return string
     */
    function get_topic() {
        return "foobar";
    }
}