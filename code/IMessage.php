<?php

namespace Ntb\QueueAdapter;

interface IMessage {
  /**
  * @return array
  */
  function get_data();

  /**
  * @return string
  */
  function get_topic();
}
