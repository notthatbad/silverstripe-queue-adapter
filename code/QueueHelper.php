<?php
class QueueHelper {

  /**
   * @return IQueueAdapter
   * @throws Exception
   */
  public static function get_queue() {
    return Injector::inst()->create('QueueAdapater');
  }

  /**
   * @return IQueueSerializer
   * @throws Exception
   */
  public static function get_serializer() {
      return Injector::inst()->create('MessageSerializer');
  }
}
