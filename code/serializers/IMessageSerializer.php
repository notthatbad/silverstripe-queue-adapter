<?php

/**
 * Provides methods for serializing data and deserializing strings.
 * @author Eduard Malyj <eduard.malyj@gmail.com>
 */
interface IMessageSerializer {
    /**
     * Serialize the data in a specific format like html, json, xml etc.
     *
     * @param array $data the data that should be serialized
     * @return string the serialized data
     */
    public function serialize($data);

    /**
     * @param string $bytes
     * @return mixed
     */
    public function deserialize($bytes);
}
