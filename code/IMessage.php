<?php

namespace Ntb\QueueAdapter;

interface IMessage {
    /**
    * @return array
    */
    function getData();

    /**
    * @return string
    */
    function getTopic();

    /**
    * @param array $data
    */
    function setData($data);
}
