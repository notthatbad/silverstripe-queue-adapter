<?php

class JSONSerializerTest extends SapphireTest {

    public function testSerialize() {
        $serializer = new Ntb\QueueAdapter\JsonSerializer();
        $data = ['foo' => 'bar'];
        $this->assertEquals(json_encode($data), $serializer->serialize($data));
    }

    public function testDeserialize() {
        $serializer = new Ntb\QueueAdapter\JsonSerializer();
        $data = ['foo' => 'bar'];
        $encoded = json_encode($data);
        $this->assertEquals($data, $serializer->deserialize($encoded));
    }

    public function testDeserializeWithWrongData() {
        $serializer = new Ntb\QueueAdapter\JsonSerializer();
        $string = "{//][Invalid JSON";
        $this->assertNull($serializer->deserialize($string));
    }

}