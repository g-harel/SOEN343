<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    // import schema before each test. schema deletes old tables.
    public static function setUpBeforeClass() {
        shell_exec("mysql -u root --password=\"\" soen343 < ./databaseSchema.sql");
    }

    use CreatesApplication;
}
