<?php
namespace App\DTOs;
use Carbon\Carbon;
use PhpParser\Node\Expr\Cast\Double;

class ProjectDTO
{
    public $id;
    public $title;
    public $division;
    public $district;
    public $upazila;
    public $housing;
    public $latitude;
    public $longitude;
    public $road;
    public $block;
    public $plot;
    public $plot_size;
    public $plot_face;
    public $is_corner;
    public $storied;
    public $no_of_units;
    public $floor_area;
    public $floor_no;
    public $no_of_beds;
    public $no_of_baths;
    public $no_of_balcony;
    public $parking_available;
    public $owner_name;
    public $owner_phone;
    public $owner_email;
    public $rate_per_sqft;
    public $total_price;
    public $description;
    public $google_map;
    public $created_at;
    public $updated_at;
    public $is_active;
    public $images;

    public $facilities;
    public $amenities;

    public function __construct($id, $title, $division, $district, $upazila, $housing,$latitude,$longitude, $road, $block, $plot, $plot_size, $plot_face, $is_corner, $storied, $no_of_units, $floor_area, $floor_no, $no_of_beds, $no_of_baths, $no_of_balcony, $parking_available, $owner_name, $owner_phone, $owner_email, $rate_per_sqft, $total_price, $description, $google_map, $created_at, $updated_at, $is_active,$project)
    {
        $this->id = $id;
        $this->title = $title;
        $this->division = $division;
        $this->district = $district;
        $this->upazila = $upazila;
        $this->housing = $housing;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->road = $road;
        $this->block = $block;
        $this->plot = $plot;
        $this->plot_size = $plot_size;
        $this->plot_face = $plot_face;
        $this->is_corner = $is_corner;
        $this->storied = $storied;
        $this->no_of_units = $no_of_units;
        $this->floor_area = $floor_area;
        $this->floor_no = $floor_no;
        $this->no_of_beds = $no_of_beds;
        $this->no_of_baths = $no_of_baths;
        $this->no_of_balcony = $no_of_balcony;
        $this->parking_available = $parking_available;
        $this->owner_name = $owner_name;
        $this->owner_phone = $owner_phone;
        $this->owner_email = $owner_email;
        $this->rate_per_sqft = $rate_per_sqft;
        $this->total_price = $total_price;
        $this->description = $description;
        $this->google_map = $google_map;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->is_active = $is_active;
        $this->images = $this->getImages($project);
        $this->amenities = $project->amenities;
        $this->facilities = $project->housing->facilities->load('category')->map(function ($facility) {
            return [
                'id' => $facility->id,
                'name' => $facility->name,
                'latitude' => $facility->latitude,
                'longitude' => $facility->longitude,
                'category' => $facility->category->label,
            ];
        });

    }

    public static function fromModel($project)
    {
        return new self(
            $project->id,
            $project->title,
            $project->division->name,
            $project->district->name,
            $project->upazila->name,
            $project->housing->name,
            $project->housing->latitude,
            $project->housing->longitude,
            $project->road,
            $project->block,
            $project->plot,
            $project->plot_size,
            $project->plot_face,
            $project->is_corner,
            $project->storied,
            $project->no_of_units,
            $project->floor_area,
            $project->floor_no,
            $project->no_of_beds,
            $project->no_of_baths,
            $project->no_of_balcony,
            $project->parking_available,
            $project->owner_name,
            $project->owner_phone,
            $project->owner_email,
            $project->rate_per_sqft,
            $project->total_price,
            $project->description,
            $project->google_map,
            $project->created_at ? Carbon::parse($project->created_at) : null,
            $project->updated_at ? Carbon::parse($project->updated_at) : null,
            $project->is_active,
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
            'road' => $this->road,
            'block' => $this->block,
            'plot' => $this->plot,
            'plot_size' => $this->plot_size,
            'plot_face' => $this->plot_face,
            'is_corner' => $this->is_corner,
            'storied' => $this->storied,
            'no_of_units' => $this->no_of_units,
            'floor_area' => $this->floor_area,
            'floor_no' => $this->floor_no,
            'no_of_beds' => $this->no_of_beds,
            'no_of_baths' => $this->no_of_baths,
            'no_of_balcony' => $this->no_of_balcony,
            'parking_available' => $this->parking_available,
            'owner_name' => $this->owner_name,
            'owner_phone' => $this->owner_phone,
            'owner_email' => $this->owner_email,
            'rate_per_sqft' => $this->rate_per_sqft,
            'total_price' => $this->total_price,
            'description' => $this->description,
            'google_map' => $this->google_map,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_active' => $this->is_active,
            'images' => $this->images,
            'facilities' => $this->facilities,
            'amenities' => $this->amenities,
        ];
    }
}
