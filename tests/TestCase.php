<?php

namespace Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Cratespace\Preflight\Testing\Concerns\AuthenticatesUser;
use Cratespace\Preflight\Testing\Concerns\InteractsWithNetwork;
use Cratespace\Preflight\Testing\Concerns\InteractsWithProtectedQualities;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use InteractsWithProtectedQualities;
    use InteractsWithNetwork;
    use AuthenticatesUser;
    use WithFaker;
}
