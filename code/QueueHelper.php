<?php

namespace Ntb\QueueAdapter;

/**
 * Factory methods for serializers and queue adapters
 */
class QueueHelper {

    /**
     * @return IQueueAdapter
     * @throws \Exception
     */
    public static function get_queue() {
        return \Injector::inst()->create('QueueAdapter');
    }

    /**
     * @return IMessageSerializer
     * @throws \Exception
     */
    public static function get_serializer() {
        return \Injector::inst()->create('MessageSerializer');
    }
}
