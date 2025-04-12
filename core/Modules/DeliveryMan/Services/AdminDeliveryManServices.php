<?php

namespace Modules\DeliveryMan\Services;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelIdea\Helper\Modules\DeliveryMan\Entities\_IH_DeliveryMan_C;
use Modules\DeliveryMan\Enums\DeliveryManStatusEnum;
use Modules\DeliveryMan\Entities\DeliveryMan;
use Modules\DeliveryMan\Entities\DeliveryManCredential;
use Modules\DeliveryMan\Entities\DeliveryManPermanentAddress;
use Modules\DeliveryMan\Entities\DeliveryManPresentAddress;

class AdminDeliveryManServices
{
    const PAGINATION_LIMIT = 20;
    private array $allowedFilesExtension = ['jped','jpg','png','pdf'];
    const IMAGE_DIRECTORY = "assets/uploads/delivery_man";

    /**
     * @throws Exception
     */
    public static function storeCredentials(int $id, mixed $data)
    {
        $license_image=null;
        $identity_image=null;
        if(isset($data["driving_license_image"])){
            $license_image = (new static)->saveImage($data["driving_license_image"], self::IMAGE_DIRECTORY);
        }
        if(isset($data["identity_image"])){
            $identity_image = (new static)->saveImage($data["identity_image"], self::IMAGE_DIRECTORY);
        }

        return DeliveryManCredential::create([
            'delivery_man_id' => $id,
            'identity_type' => $data['identity_type'] ?? null,
            'identity_number' => $data['identity_number'] ?? null,
            'vehicle_type' => $data['vehicle_type'] ?? null,
            'license_number' => $data['license_number'] ?? null,
            'identity_image' => $identity_image ?? null,
            'license_image' => $license_image ?? null,
        ]);
    }

    /**
     * @throws Exception
     */
    public function saveImage($image, $directory): ?string
    {
        // checked image type with extension
        $extension = $image->extension();


        // Check if the file extension is allowed
        if (!in_array($extension, $this->allowedFilesExtension)) {
            throw new Exception('The file you have uploaded with '. $extension .' extension are not allowed.');
        }elseif(in_array($extension, $this->allowedFilesExtension)){
            // generate file name
            $filename = uniqid() . '.' . $extension;
            $image->move($directory, $filename);

            return $filename;
        }

        return null;
    }

    public function storeDeliveryMan($data){
        // store profile image
        $profile_img=null;
        if(isset($data['profile_image'])){
            $profile_img = $this->saveImage($data['profile_image'], self::IMAGE_DIRECTORY);
        }
        return DeliveryMan::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'gender' => $data['gender'] ?? 'man',
            'email' => $data['email'],
            'phone' => $data['phone'],
            'profile_img' => $profile_img,
            'password' => \Hash::make($data['password']),
            'zone_id' => $data['zone_id'],
            'status' => DeliveryManStatusEnum::ACTIVE->value,
            'delivery_man_type' => $data['delivery_man_type']
        ]);
    }

    public static function storePermanentAddress($id, $data){
        return DeliveryManPermanentAddress::create([
            'delivery_man_id' => $id,
            'country_id' => $data["permanent_country_id"] ?? null,
            'state_id' => $data["permanent_state_id"] ?? null,
            'city_id' => $data["permanent_city_id"] ?? null,
            'zip_code' => $data["permanent_zip_code"] ?? null,
            'address_one' => $data["permanent_address_one"] ?? null,
            'address_two' => $data["permanent_address_two"] ?? null,
        ]);
    }

    public static function storePresentAddress($id, $data){
        return DeliveryManPresentAddress::create([
            'delivery_man_id' => $id,
            'country_id' => $data["present_country_id"] ?? null,
            'state_id' => $data["present_state_id"] ?? null,
            'city_id' => $data["present_city_id"] ?? null,
            'zip_code' => $data["present_zip_code"] ?? null,
            'address_one' => $data["present_address_one"] ?? null,
            'address_two' => $data["present_address_two"] ?? null,
        ]);
    }

    public static function getDeliveryMan($request, $deliveryManId = null)
    {
        $deliveryMan = DeliveryMan::query()->with(["credentials", "zone:id,name"])
            ->when($request->has("name"), function ($query) use ($request){
                $searchTerms = explode(' ', trim(strip_tags($request->name)));

                foreach ($searchTerms as $term) {
                    $query->where(function ($subQuery) use ($term) {
                        $subQuery->where('first_name', 'LIKE', "%$term%")
                            ->orWhere('last_name', 'LIKE', "%$term%");
                    });
                }

                return $query;
            })
            ->withSum("deliveryManOrder","commission_amount")// this line will be removed
            ->withAvg("ratings","rating")
            ->withCount([
                "deliveryManOrder" => function ($query){
                    $query->whereHas("order.orderTrack", function ($od_query){
                        $od_query->where("name","=", "delivered");
                    });
                },
                "deliveryManOrder as delivery_man_total_orders_count",
                "ratings"
            ])
            ->when($request->has("zone_id"), function ($query) use ($request) {
                if($request->zone_id != 0){
                    $query->where("zone_id", $request->zone_id);
                }
            })
            ->latest("id");

        if(!is_null($deliveryManId)) {
            $deliveryMan = $deliveryMan->find($deliveryManId);
        }

        if(is_null($deliveryManId)){
            $deliveryMan = $deliveryMan->paginate(self::PAGINATION_LIMIT);
        }

        return $deliveryMan;
    }

    /**
     * @throws Exception
     */
    public static function updateDeliveryMan(mixed $data, $oldDelivery): bool
    {
        // check password if password is entered newly then generate new hash key other wise give a empty array
        $password = !empty($data['password']) ? ['password' => \Hash::make($data['password'])] : [];
        if(empty($data['profile_image'])){
            // profile image not changed
            $profile_img = $oldDelivery->profile_img;
        }else{
            // store profile image
            $profile_img = (new static)->saveImage($data['profile_image'], self::IMAGE_DIRECTORY);
        }

        // update delivery man information here
        return DeliveryMan::where("id", $oldDelivery->id)->update([
            'first_name' => $data['first_name'] ?? $oldDelivery->first_name,
            'last_name' => $data['last_name'] ?? $oldDelivery->last_name,
            'gender' => $data['gender'] ?? $oldDelivery->gender,
            'email' => $data['email'] ?? $oldDelivery->email,
            'phone' => $data['phone'] ?? $oldDelivery->phone,
            'profile_img' => $profile_img,
            'zone_id' => $data['zone_id'] ?? $oldDelivery->zone_id,
            'delivery_man_type' => $data['delivery_man_type'] ?? $oldDelivery->delivery_man_type
        ] + $password);
    }

    public static function updatePermanentAddress(mixed $data,mixed $oldDelivery): bool
    {
        return DeliveryManPermanentAddress::where('delivery_man_id' , $oldDelivery->id)->update([
            'country_id' => $data["permanent_country_id"] ?? $oldDelivery->country_id,
            'state_id' => $data["permanent_state_id"] ?? $oldDelivery->state_id,
            'city_id' => $data["permanent_city_id"] ?? $oldDelivery->city_id,
            'zip_code' => $data["permanent_zip_code"] ?? $oldDelivery->zip_code,
            'address_one' => $data["permanent_address_one"] ?? $oldDelivery->address_one,
            'address_two' => $data["permanent_address_two"] ?? $oldDelivery->address_two,
        ]);
    }

    public static function updatePresentAddress(mixed $data,mixed $oldDelivery): bool
    {
        return DeliveryManPresentAddress::where('delivery_man_id', $oldDelivery->id)->update([
            'country_id' => $data["present_country_id"] ?? $oldDelivery->country_id,
            'state_id' => $data["present_state_id"] ?? $oldDelivery->state_id,
            'city_id' => $data["present_city_id"] ?? $oldDelivery->city_id,
            'zip_code' => $data["present_zip_code"] ?? $oldDelivery->zip_code,
            'address_one' => $data["present_address_one"] ?? $oldDelivery->address_one,
            'address_two' => $data["present_address_two"] ?? $oldDelivery->address_two,
        ]);
    }

    /**
     * @throws Exception
     */
    public static function updateCredentials(mixed $data,mixed $oldDelivery, $delivery_man_id = null): DeliveryManCredential
    {
        $license_image = !empty($data["driving_license_image"] ?? "") ? (new static)->saveImage($data["driving_license_image"], self::IMAGE_DIRECTORY) : ($oldDelivery->license_image ?? "");
        $identity_image = !empty($data["identity_image"] ?? "") ? (new static)->saveImage($data["identity_image"], self::IMAGE_DIRECTORY) : ($oldDelivery->identity_image ?? "");

        return DeliveryManCredential::updateOrCreate(['delivery_man_id' => ($oldDelivery->delivery_man_id ?? $delivery_man_id)],[
            'delivery_man_id' => ($oldDelivery->delivery_man_id ?? $delivery_man_id),
            'identity_type' => $data['identity_type'] ?? ($oldDelivery->identity_type ?? ''),
            'identity_number' => $data['identity_number'] ?? ($oldDelivery->identity_number ?? ''),
            'vehicle_type' => $data['vehicle_type'] ?? ($oldDelivery->vehicle_type ?? ''),
            'license_number' => $data['license_number'] ?? ($oldDelivery->license_number ?? ''),
            'identity_image' => $identity_image,
            'license_image' => $license_image,
        ]);
    }
}