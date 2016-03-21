<?php

namespace Ntb\QueueAdapter;

/**
 * Provides methods for simple queue messaging
 * @author Eduard Malyj <eduard.malyj@gmail.com>
 */
interface IQueueAdapter {
    /**
     * @param IMessage $msg
     */
    function publish($msg);

    /**
     * @param string $queue
     * @return mixed
     */
    function read($queue);
}
