<?php

namespace App\Http\Services\Media;

use App\MediaUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Storage;
class MediaHelper
{

    public static function fetch_media_image($request,$type='admin'): array
    {
        $image_query = MediaUpload::query();

        if ($type === 'web'){
            $image_query->where(['user_id' => auth($type)->id()]);
        }
        $all_images = $image_query->where(['type' => $type])->orderBy('id', 'DESC')->take(20)->get();
        $selected_image = MediaUpload::find($request->selected);

        $all_image_files = [];
        if (!empty($selected_image)){
            if (file_exists('assets/uploads/media-uploader/'.$selected_image->path)) {

                $image_url = asset('assets/uploads/media-uploader/' . $selected_image->path);
                if (file_exists('assets/uploads/media-uploader/grid-' . $selected_image->path)) {
                    $image_url = asset('assets/uploads/media-uploader/grid-' . $selected_image->path);
                    $image_url = asset('assets/uploads/media-uploader/semi-large-' . $selected_image->path);
                }
//todo add video  code
                $all_image_files[] = [
                    'image_id' => $selected_image->id,
                    'title' => $selected_image->title,
                    'dimensions' => $selected_image->dimensions,
                    'type' => pathinfo($image_url,PATHINFO_EXTENSION),
                    'alt' => $selected_image->alt,
                    'size' => $selected_image->size,
                    'path' => $selected_image->path,
                    'img_url' => $image_url,
                    'upload_at' => date_format($selected_image->created_at, 'd M y')
                ];
            }

        }
        foreach ($all_images as $image){
            //todo add video  code
            if (file_exists('assets/uploads/media-uploader/'.$image->path)){
                $image_url = asset('assets/uploads/media-uploader/'.$image->path);
                if (file_exists('assets/uploads/media-uploader/grid-' . $image->path)) {
                    $image_url = asset('assets/uploads/media-uploader/grid-' . $image->path);
                }
                $all_image_files[] = [
                    'image_id' => $image->id,
                    'title' => $image->title,
                    'dimensions' => $image->dimensions,
                    'alt' => $image->alt,
                    'type' => pathinfo($image_url,PATHINFO_EXTENSION),
                    'size' => $image->size,
                    'path' => $image->path,
                    'img_url' => $image_url,
                    'upload_at' => date_format($image->created_at, 'd M y')
                ];

            }
        }
        return $all_image_files;
    }

    public static function delete_media_image($request,$type ='admin'): void
    {
        $get_image_details = MediaUpload::find($request->img_id);
        if (file_exists('assets/uploads/media-uploader/' . $get_image_details->path)) {
            unlink('assets/uploads/media-uploader/' . $get_image_details->path);
        }
        if (file_exists('assets/uploads/media-uploader/grid-' . $get_image_details->path)) {
            unlink('assets/uploads/media-uploader/grid-' . $get_image_details->path);
        }
        if (file_exists('assets/uploads/media-uploader/large-' . $get_image_details->path)) {
            unlink('assets/uploads/media-uploader/large-' . $get_image_details->path);
        }
        if (file_exists('assets/uploads/media-uploader/semi-large-' . $get_image_details->path)) {
            unlink('assets/uploads/media-uploader/semi-large-' . $get_image_details->path);
        }
        if (file_exists('assets/uploads/media-uploader/thumb-' . $get_image_details->path)) {
            unlink('assets/uploads/media-uploader/thumb-' . $get_image_details->path);
        }

        $image_query = MediaUpload::query();
        //todo add video delete code

        if ($type === 'web'){
            $image_query->where(['type' => $type,'user_id' => auth($type)->id()]);
        }
        $image_query->where(['id' => $request->img_id])->delete();
    }

    public static function insert_media_image($file,$type='admin',$file_field_name = 'file'): MediaUpload|Model|null
    {
        $image = $file;
        $image_dimension = getimagesize($image);
        $image_extenstion = $image->extension();

        $image_size_for_db = $image->getSize();

        $image_name_with_ext = $image->getClientOriginalName();
        $image_name = pathinfo($image_name_with_ext, PATHINFO_FILENAME);
        $image_name = strtolower(Str::slug($image_name));
        $image_db = $image_name . time() . '.' . $image_extenstion;
        $folder_path = 'assets/uploads/media-uploader/';
        $image_width = 0;
        //check if it is video
        $isVideo = true;

        // this will check who is uploading file
        $userId = [];
        if(auth('web')->check()){
            $userId = [
                'user_id' => auth('web')->user()->id
            ];
        }elseif (auth('vendor')->check()){
            $userId = [
                'vendor_id' => auth('vendor')->user()->id
            ];
        }elseif (auth('admin')->check()){
            $userId = [
                'admin_id' => auth('admin')->user()->id
            ];
        }

        if( in_array($image_extenstion,['mp4','avi','flv']) ){
            //write function to store video

        }else if($image_extenstion == 'svg'){
            $image_name_with_ext = $image->getClientOriginalName();
            $image_db = $image_name . time() . '.' . $image_extenstion;
            $folder_path .= "svg/";
            $file->move($folder_path, $image_db);
            $image_size_for_db = '';
            $image_dimension_for_db = '';
            $image_db = "svg/" . $image_db;

            return MediaUpload::create([
                'title' => $image_name_with_ext,
                'size' => '',
                'path' => $image_db,
                'dimensions' => $image_dimension_for_db,
                'type' => $type,
                'user_id' => auth($type)->id(),
            ] + $userId);
        }else{
            $isVideo = false;
            //it's an image

            $image_width = $image_dimension[0];
            $image_height = $image_dimension[1];
            $image_dimension_for_db = $image_width . ' x ' . $image_height . ' pixels';

            $image_grid = 'grid-' . $image_db;
            $image_large = 'large-' . $image_db;
            $image_thumb = 'thumb-' . $image_db;
            $image_semi_large = 'semi-large-' . $image_db;
            $image_box = 'box-' . $image_db;

            $resize_grid_image = Image::make($image)->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $resize_large_image = Image::make($image)->resize(740, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $resize_semi_large_image = Image::make($image)->resize(530, 350, function ($constraint) {
                $constraint->aspectRatio();
            });

            $image_box_image = Image::make($image)->resize(527, 427, function ($constraint) {
                $constraint->aspectRatio();
            });

            $resize_thumb_image = Image::make($image)->resize(200, 200);
        }

        $image = Image::make($file);

        Storage::disk('asset_path')->put($folder_path.$image_db, (string) $image->encode());

        if ($image_width > 150 && !$isVideo) {
            $resize_thumb_image->save($folder_path . $image_thumb);
            $resize_grid_image->save($folder_path . $image_grid);
            $resize_large_image->save($folder_path . $image_large);
            $resize_semi_large_image->save($folder_path . $image_semi_large);
            $image_box_image->save($folder_path . $image_box);
        }

        return MediaUpload::create([
            'title' => $image_name_with_ext,
            'size' => formatBytes($image_size_for_db),
            'path' => $image_db,
            'dimensions' => $image_dimension_for_db ?? '',
            'type' => $type,
            'mime_type' => $image_extenstion,
            'user_id' => auth($type)->id(),
        ] + $userId);
    }


    public static function load_more_images($request,$type = 'admin'): array
    {

        $image_query = MediaUpload::query();

        if ($type === 'web'){
            $image_query->where(['type' => $type,'user_id' => auth($type)->id()]);
        }

        $all_images = $image_query->orderBy('id', 'DESC')->skip($request->skip)->take(20)->get();

        $all_image_files = [];
        foreach ($all_images as $image){
            if (file_exists('assets/uploads/media-uploader/'.$image->path)){
                $image_url = asset('assets/uploads/media-uploader/'.$image->path);
                if (file_exists('assets/uploads/media-uploader/grid-' . $image->path)) {
                    $image_url = asset('assets/uploads/media-uploader/grid-' . $image->path);
                }
                $all_image_files[] = [
                    'image_id' => $image->id,
                    'title' => $image->title,
                    'dimensions' => $image->dimensions,
                    'type' => pathinfo($image_url,PATHINFO_EXTENSION),
                    'alt' => $image->alt,
                    'size' => $image->size,
                    'path' => $image->path,
                    'img_url' => $image_url,
                    'upload_at' => date_format($image->created_at, 'd M y')
                ];

            }
        }
        return $all_image_files;
    }
}