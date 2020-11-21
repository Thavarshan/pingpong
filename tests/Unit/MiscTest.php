<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class MiscTest extends TestCase
{
    /** @test */
    public function hash_value_with_null_input()
    {
        $this->assertFalse(Hash::check('d73sabld73go8phd8saxih', null));
    }
}
