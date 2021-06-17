<?php

namespace Tests\Feature\Contacts;

use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteContactTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The faker user instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * The fake contact instance.
     *
     * @var \App\Models\Contact
     */
    protected $contact;

    protected function setUp(): void
    {
        parent::setUp();

        $this->signIn($this->user = create(User::class));

        $this->contact = create(Contact::class, ['user_id' => $this->user->id]);
    }

    public function testDeleteContact()
    {
        $response = $this->delete('/contacts/' . $this->contact->slug);

        $response->assertStatus(303);
        $response->assertRedirect('/contacts');
    }

    public function testDeleteContactThroughJsonRequest()
    {
        $response = $this->deleteJson('/contacts/' . $this->contact->slug);

        $response->assertStatus(200);
    }
}
