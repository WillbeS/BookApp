<?php

namespace Database;

use Generator;

interface ResultSetInterface
{
    public function fetch($className):Generator;
}