<?php
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
