<?php

namespace Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Emberfuse\Blaze\Testing\Concerns\AuthenticatesUser;
use Emberfuse\Blaze\Testing\Concerns\InteractsWithNetwork;
use Emberfuse\Blaze\Testing\Concerns\InteractsWithProtectedQualities;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use InteractsWithProtectedQualities;
    use InteractsWithNetwork;
    use AuthenticatesUser;
    use WithFaker;
}
