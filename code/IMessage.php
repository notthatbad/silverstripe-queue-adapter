<?php
interface IMessage {
  /**
  * @return array
  */
  function getData();

  /**
  * @return string
  */
  function getQueue();
}
