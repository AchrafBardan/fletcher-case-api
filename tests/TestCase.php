<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use OwowAgency\Snapshots\MatchesSnapshots;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase, MatchesSnapshots;

    protected function setUp(): void
    {
        parent::setUp();

        $this->refreshDatabase();
    }
}
