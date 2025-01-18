<?php
namespace App\DTOs;
use Carbon\Carbon;
use PhpParser\Node\Expr\Cast\Double;

class ProjectListDTO
{
    public $id;
    public $title;
    public $district;
    public $upazila;
    public $housing;
    public $no_of_beds;
    public $no_of_baths;
    public $no_of_balcony;
    public $rate_per_sqft;
    public $total_price;
    public $description;
    public $images;
    public function __construct($id, $title, $district, $upazila, $housing,$no_of_beds, $no_of_baths, $no_of_balcony, $rate_per_sqft, $total_price, $description,$project)
    {
        $this->id = $id;
        $this->title = $title;
        $this->district = $district;
        $this->upazila = $upazila;
        $this->housing = $housing;
        $this->no_of_beds = $no_of_beds;
        $this->no_of_baths = $no_of_baths;
        $this->no_of_balcony = $no_of_balcony;
        $this->rate_per_sqft = $rate_per_sqft;
        $this->total_price = $total_price;
        $this->description = $description;
        $this->images = $this->getImages($project);
    }

    public static function fromModel($project)
    {
        return new self(
            $project->id,
            $project->title,
            $project->district->name_bn,
            $project->upazila->name_bn,
            $project->housing->name,
            $project->no_of_beds,
            $project->no_of_baths,
            $project->no_of_balcony,
            $project->rate_per_sqft,
            $project->total_price,
            $project->description,
            $project
        );
    }

    public function getImages($project)
    {
        $mediaItems = $project->getMedia('project_image'); // Use your media collection name
        $mediaUrls = $mediaItems->map(function ($media) {
            return $media->getUrl();
        });
        $project->images = $mediaUrls;
        return $mediaUrls;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'division' => $this->division_id,
            'district' => $this->district_id,
            'upazila' => $this->upazila_id,
            'housing' => $this->housing_id,
            'no_of_beds' => $this->no_of_beds,
            'no_of_baths' => $this->no_of_baths,
            'no_of_balcony' => $this->no_of_balcony,
            'rate_per_sqft' => $this->rate_per_sqft,
            'total_price' => $this->total_price,
            'description' => $this->description,
            'images' => $this->images
        ];
    }
}
