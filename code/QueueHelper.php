<?php
class QueueHelper {
  public static function getQueue() {
    return Injector::inst()->create('QueueAdapater');
  }

  /**
   * @return IQueueSerializer
   * @throws Exception
   */
  public static function get_serializer() {
      return Injector::inst()->create('QueueSerializer');
  }
}
