<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Projects;

class ProjectsTest extends TestCase
{
    private $path = '/projects';

    public function testProjectsIndex(): Void
    {
        $response = $this->get($this->path);
        $response->assertOk();
    }

    public function testProjectsStore(): Void
    {
        $newProjects = Projects::factory()->make();

        $response = $this->postJson(
            route($this->path . '/create', $newProjects),
            $newProjects->toArray()
        );

        $response->assertCreated();
        $response->assertJson([
             'data' => ['type' => $newProjects->type]
        ]);

        $this->assertDatabaseHas(
             'projects',
             $newProjects->toArray()
         );
    }

    public function testProjectsEdit(): Void
    {
        $existingProjects = Projects::factory()->create();
		$newProjects = Projects::factory()->make();

		$response = $this->putJson(
			route($this->path . '/edit', $existingProjects),
			$newProjects->toArray()
		);

		$response->assertJson([
			'data' => [
				'id' => $existingProjects->id,
				'name' => $newProjects->name,
				'type' => $newProjects->type
			]
		]);

		$this->assertDatabaseHas(
			'projects',
			$newProjects->toArray()
		);
    }

    public function testProjectsDelete(): Void
    {
        $existingProject = Projects::factory()->create();

		$this->deleteJson(
			route($this->path . '/destroy', $existingProject)
		)->assertNoContent();

        $this->assertDatabaseMissing(
			'projects',
			$existingProject->toArray()
		);
    }
}
