<?php

@mkdir('/tmp/storage/framework/cache', 0777, true);
@mkdir('/tmp/storage/framework/sessions', 0777, true);
@mkdir('/tmp/storage/framework/views', 0777, true);

require __DIR__ . '/../public/index.php';
