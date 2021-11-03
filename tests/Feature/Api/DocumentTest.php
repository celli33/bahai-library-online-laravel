<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;

use App\Models\Document;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_documents_list()
    {
        $documents = Document::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.documents.index'));

        $response->assertOk()->assertSee($documents[0]->slug);
    }

    /**
     * @test
     */
    public function it_stores_the_document()
    {
        $data = Document::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.documents.store'), $data);

        $this->assertDatabaseHas('documents', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_document()
    {
        $document = Document::factory()->create();

        $data = [
            'slug' => Str::slug($this->faker->text(255)),
            'is_pdf' => $this->faker->boolean,
            'is_audio' => $this->faker->boolean,
            'is_image' => $this->faker->boolean,
            'is_video' => $this->faker->boolean,
            'is_html' => $this->faker->boolean,
            'file_url' => $this->faker->text(255),
            'blurb' => $this->faker->text,
            'content_html' => $this->faker->text,
            'content_size' => $this->faker->randomNumber,
            'edit_quality' => 'high',
            'formatting_quality' => 'high',
            'publication_permission' => 'author',
            'notes' => $this->faker->text,
            'input_type' => 'scanned',
            'publication_approval' => 'approved',
            'views' => 0,
        ];

        $response = $this->putJson(
            route('api.documents.update', $document),
            $data
        );

        $data['id'] = $document->id;

        $this->assertDatabaseHas('documents', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_document()
    {
        $document = Document::factory()->create();

        $response = $this->deleteJson(
            route('api.documents.destroy', $document)
        );

        $this->assertSoftDeleted($document);

        $response->assertNoContent();
    }
}
