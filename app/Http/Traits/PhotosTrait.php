<?php

namespace App\Http\Traits;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

trait PhotosTrait
{

    // more images
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    private function saveImg($image, $model)
    {
        // foreach ($image_names as $image) {
        $path = $image->storePublicly('images/albums', "public");
        $image = "/storage/" . $path;
        $model->images()->create(['name' => $image]);
        // }
    }

    // update images in database
    public function updateImages($new_images, $model)
    {
        $this->deleteImages($model);
        foreach ($new_images as $image) {
            # code...
            $this->saveImg($image, $model);
        }
    }
    // more images

    public function deleteImages($model)
    {

        foreach ($model->images as $image) {
            // $path = 'storage/images/albums/'.$image?->name;
            $path = preg_replace("/[\s\S]*storage/", '', $image?->name);
            Storage::disk('public')->delete($path);
            $image->delete();
        }
    }

}
