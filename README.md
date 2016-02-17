Silverstripe Queue Adapter
==========================

[![Build Status](https://travis-ci.org/notthatbad/silverstripe-rest-api.svg)](https://travis-ci.org/notthatbad/silverstripe-queue-adapter)
[![License](https://poser.pugx.org/ntb/silverstripe-queue-adapter/license.svg)](https://github.com/notthatbad/silverstripe-queue-adapter/blob/master/LICENCE)

Queue adapter module for Silverstripe

## Usage

You can define your messages by implementing the `IMessage` interface. To send a message you can call `publish` on an
`IQueueAdapter`.

```php
<?php

$msg = new FooBarMessage("data");
$adapter = QueueHelper::get_queue();
$adapter->publish($msg);

```