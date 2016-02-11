<?php
interface IQueueAdapter {
  /**
  * @param $msg mixed
  */
  function publish($msg);

  /**
  * @param $msg mixed
  */
  function subscribe($queue);
}
