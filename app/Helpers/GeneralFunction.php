<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;

class GeneralFunction{
    public function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000){
	  // convert from degrees to radians
	  $latFrom = deg2rad($latitudeFrom);
	  $lonFrom = deg2rad($longitudeFrom);
	  $latTo = deg2rad($latitudeTo);
	  $lonTo = deg2rad($longitudeTo);

	  $latDelta = $latTo - $latFrom;
	  $lonDelta = $lonTo - $lonFrom;

	  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
	    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
	  return $angle * $earthRadius;
	}

	public function imageFromUrl($url){
		//$url = "https://homepages.cae.wisc.edu/~ece533/images/airplane.png";
		if(isset($url)){
			try {
		        $allowed_extension = array("jpg","png","jpeg");
				$url_array = explode("/", $url);
				$image_name = end($url_array);
				$image_array = explode(".", $image_name);
				$extension = end($image_array);
				if(in_array($extension, $allowed_extension)){
					$extension = $extension;
				} else{
					$extension = "jpg";
				}
				$file = file_get_contents($url);
				$folder_name = 'img/uploads/products/';
				$product_image_location = "";
				$name = uniqid().'.'.$extension;
				$product_image_location = $folder_name.$name;
				if (!file_exists($folder_name)) {
					mkdir($folder_name, 777, true);
				}
				ini_set('memory_limit', '256M');
				Image::make($file)->fit(300,300)->save(public_path($product_image_location),80);
				chmod($product_image_location, 0777);
				$message = 'Image Uploaded';
				$image = $product_image_location;
				$error_message = null;
				//$image = asset($product_image_location);
		    }catch (\Exception $e){            
				$message = "Image not found";
				$image = null;
				$error_message = $e;
		    }
			
		} else{
			$message = 'Invalid Url';
			$image = null;
			$error_message = 'Invalid Url';
		}
		$output = (object)array(
			'message' => $message,
			'image'  => $image,
			'error_message'  => $error_message
		);

		return $output;
	}
}

?>