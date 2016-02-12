<?php

/**
 * Serializer and deserializer for json.
 * @author Eduard Malyj <eduard.malyj@gmail.com>
 */
class JsonSerializer implements IMessageSerializer {
    /**
     * Serializes the given data into a json string.
     *
     * @param array $data the data that should be serialized
     * @return string a json formatted string
     */
    public function serialize($data) {
        return json_encode($data);
    }

    /**
     * Deserializes the given json string into mixed.
     *
     * @param string $bytes the json string that should be deserialized
     * @return mixed formatted data
     */
    public function deserialize($bytes) {
        return json_decode($bytes);
    }


}
