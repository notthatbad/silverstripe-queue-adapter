<?php

namespace Ntb\QueueAdapter;

/**
 * Provides methods for simple queue messaging
 * @author Eduard Malyj <eduard.malyj@gmail.com>
 */
interface IQueueAdapter {
  /**
  * @param $msg mixed
  */
  function publish($msg);
}
