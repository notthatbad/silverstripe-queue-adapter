<?php

namespace Ntb\QueueAdapter;

/**
 * Provides methods for simple queue messaging
 * @author Eduard Malyj <eduard.malyj@gmail.com>
 */
interface IQueueAdapter {
    /**
     * Publish a message into the queue defined by the message.
     *
     * @param IMessage $msg the message
     */
    function publish($msg);

    /**
     * Reads data from a queue and returns it.
     *
     * @param string $queue
     * @return mixed
     */
    function read($queue);


    /**
     * Reads data from a queue and stores the data into a given message. The message will be returned. If an error
     * occurred or no data is provided, the method returns FALSE.
     *
     * @param IMessage $message the message without data
     * @return IMessage|bool the filled message object
     */
    function readInto($message);
}
