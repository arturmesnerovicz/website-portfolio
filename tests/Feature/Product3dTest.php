<?php

namespace Tests\Feature;

use App\Models\Product3dModel;
use App\Models\SiteSetting;
use App\Models\User;
use Database\Seeders\ContentSeeder;
use Database\Seeders\Product3dSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class Product3dTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(ContentSeeder::class);
        $this->seed(Product3dSeeder::class);
    }

    public function test_home_page_renders_3d_section_when_enabled(): void
    {
        SiteSetting::updateOrCreate(
            ['key' => 'section_3d_enabled'],
            ['value' => '1', 'group' => 'product_3d', 'type' => 'boolean']
        );

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('id="experiencia-3d"', false);
        $response->assertSee('id="product-3d-canvas"', false);
        $response->assertSee('id="product-3d-data"', false);
    }

    public function test_home_page_hides_3d_section_when_disabled(): void
    {
        SiteSetting::updateOrCreate(
            ['key' => 'section_3d_enabled'],
            ['value' => '0', 'group' => 'product_3d', 'type' => 'boolean']
        );

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('id="experiencia-3d"', false);
    }

    public function test_product_3d_model_payload_structure(): void
    {
        $model = Product3dModel::first();
        $this->assertNotNull($model, 'Seed data should have at least one 3D model.');

        $payload = $model->toFrontendPayload();

        $this->assertArrayHasKey('id', $payload);
        $this->assertArrayHasKey('slug', $payload);
        $this->assertArrayHasKey('name', $payload);
        $this->assertArrayHasKey('badge', $payload);
        $this->assertArrayHasKey('modelUrl', $payload);
        $this->assertArrayHasKey('cameraSettings', $payload);
        $this->assertArrayHasKey('transformSettings', $payload);
        $this->assertArrayHasKey('parts', $payload);

        $this->assertNotEmpty($payload['name']);
        $this->assertNotEmpty($payload['modelUrl']);
        $this->assertNotEmpty($payload['parts']);

        $firstPart = $payload['parts'][0];
        $this->assertArrayHasKey('id', $firstPart);
        $this->assertArrayHasKey('name', $firstPart);
        $this->assertArrayHasKey('mesh_name', $firstPart);
        $this->assertArrayHasKey('options', $firstPart);
        $this->assertNotEmpty($firstPart['options']);
    }

    public function test_english_route_loads_english_translations(): void
    {
        SiteSetting::updateOrCreate(
            ['key' => 'section_3d_enabled'],
            ['value' => '1', 'group' => 'product_3d', 'type' => 'boolean']
        );

        $response = $this->get('/en');

        $response->assertStatus(200);
        $response->assertSee('id="experiencia-3d"', false);
        $response->assertSee('DESIGN &amp; ENGINEERING', false);
    }

    public function test_section_3d_has_light_background_and_zoom_controls(): void
    {
        SiteSetting::updateOrCreate(
            ['key' => 'section_3d_enabled'],
            ['value' => '1', 'group' => 'product_3d', 'type' => 'boolean']
        );
        SiteSetting::updateOrCreate(
            ['key' => 'section_3d_allow_zoom'],
            ['value' => '1', 'group' => 'product_3d', 'type' => 'boolean']
        );

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('data-bg="light"', false);
        $response->assertSee('bg-[#ddddd5]', false);
        $response->assertSee('id="product-3d-zoom-controls"', false);
        $response->assertSee('id="product-3d-zoom-in"', false);
        $response->assertSee('id="product-3d-zoom-out"', false);
    }

    public function test_global_zoom_toggle_disables_zoom_in_payload(): void
    {
        SiteSetting::updateOrCreate(
            ['key' => 'section_3d_enabled'],
            ['value' => '1', 'group' => 'product_3d', 'type' => 'boolean']
        );
        SiteSetting::updateOrCreate(
            ['key' => 'section_3d_allow_zoom'],
            ['value' => '0', 'group' => 'product_3d', 'type' => 'boolean']
        );

        $response = $this->get('/');

        $response->assertStatus(200);
        $this->assertFalse($response->viewData('product3dPayload')['allowZoom']);
        $response->assertSee('"allowZoom":false', false);
    }

    public function test_admin_can_access_studio_3d_cluster_and_product_3d_models_list(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/estudio-3d/product3d-models');

        $response->assertStatus(200);
        $response->assertSee('Modelos 3D');
        $response->assertSee('Cabo Ágilis');
    }

    public function test_admin_can_access_manage_product_3d_section_page(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/estudio-3d/manage-product3d-section');

        $response->assertStatus(200);
        $response->assertSee('Configuração da Seção 3D');
    }

    public function test_admin_can_access_product_3d_model_create_page(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/estudio-3d/product3d-models/create');

        $response->assertStatus(200);
        $response->assertSee('Nome do Produto');
        $response->assertSee('Arquivo 3D');
        $response->assertSee('Upload do Arquivo (.glb)');
        $response->assertSee('Partes Configuráveis &amp; Materiais', false);
    }

    public function test_admin_can_access_product_3d_model_edit_page(): void
    {
        $admin = User::factory()->create();
        $model = Product3dModel::first();

        $response = $this->actingAs($admin)->get('/admin/estudio-3d/product3d-models/'.$model->id.'/edit');

        $response->assertStatus(200);
        $response->assertSee($model->slug);
    }

    public function test_glb_upload_validation_accepts_lowercase_and_uppercase_files(): void
    {
        Storage::fake('public');

        $fileLower = UploadedFile::fake()->create('blender_export.glb', 1024, 'application/octet-stream');
        $fileUpper = UploadedFile::fake()->create('blender_export.GLB', 1024, 'application/octet-stream');
        $fileGltfMime = UploadedFile::fake()->create('blender_export.glb', 1024, 'model/gltf-binary');

        $rules = [
            'file' => [
                'file',
                'extensions:glb,GLB',
                'mimetypes:.glb,.GLB,glb,GLB,model/gltf-binary,model/gltf+json,application/octet-stream,application/json',
            ],
        ];

        $vLower = Validator::make(['file' => $fileLower], $rules);
        $this->assertTrue($vLower->passes(), 'Lowercase .glb should pass validation');

        $vUpper = Validator::make(['file' => $fileUpper], $rules);
        $this->assertTrue($vUpper->passes(), 'Uppercase .GLB should pass validation');

        $vGltf = Validator::make(['file' => $fileGltfMime], $rules);
        $this->assertTrue($vGltf->passes(), 'MIME model/gltf-binary .glb should pass validation');

        $fileInvalid = UploadedFile::fake()->create('invalid.txt', 100, 'text/plain');
        $vInvalid = Validator::make(['file' => $fileInvalid], $rules);
        $this->assertFalse($vInvalid->passes(), 'Invalid extension should fail validation');
    }
}
