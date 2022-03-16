<?php

namespace Cinebaz\Member\Traits;

use App\Models\Member;
use Cinebaz\Member\Models\MemberPicture;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait TPicture
{
    public function imgPost($data)
    {
        // dd($data);
        $default = [
            'data' => null,
            'able_id' => null,
            'able_type' => null,
        ];

        $final = array_merge($default, $data);
        $request = $final['data'];
        if ($request->id) {
            $media = Member::find($request->id);
            $media->allimages()->delete();
        }

        if ($request->image) {
            $attributes = [
                'imageable_id'      => $final['able_id'],
                'imageable_type'    => $final['able_type'],

                'name'              => null,
                'file_name'         => null,
                'featured'          => true,
                'mime_type'         => null,
                'small'             => $request->image[0],
                'medium'            => $request->image[0],
                'full'              => $request->image[0],
                'thumbnail'         => $request->image[0],
                'remarks'           => $request->get('remarks'),
                'sort_by'           => $request->get('sort_by'),
                'is_active'         => 'Yes',
                'modified_by'       => auth('web')->user()->id,
            ];
            // dd($attributes);
            MemberPicture::create($attributes);
        }

        if ($request->post_file) {
            foreach ($request->post_file as $list) {
                $attributes = [
                    'imageable_id'      => $final['able_id'],
                    'imageable_type'    => $final['able_type'],

                    'name'              => null,
                    'file_name'         => null,
                    'featured'          => false,
                    'mime_type'         => null,
                    'small'             => $list,
                    'medium'            => $list,
                    'full'              => $list,
                    'thumbnail'         => $list,
                    'remarks'           => $request->get('remarks'),
                    'sort_by'           => $request->get('sort_by'),
                    'is_active'         => 'Yes',
                    'modified_by'       => auth('web')->user()->id,
                ];
                MemberPicture::create($attributes);
                //dump($attributes);
            }
        }
    }
    public function imgUpload($data)
    {
        // dd($data);
        $default = [
            'data' => null,
            'able_id' => null,
            'able_type' => null,
        ];
        
        $final = array_merge($default, $data);
        $request = $final['data'];
        if ($request->id) {
            $media = Member::find($request->id);
            $media->allimages()->delete();
        }


            // Get file from request
            $file = $request->file('image');
         

            // Get filename with extension
            $filenameWithExt = $file->getClientOriginalName();

            // Get file path
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Remove unwanted characters
            $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
            $filename = preg_replace("/\s+/", '-', $filename);

            // Get the original image extension
            $extension = $file->getClientOriginalExtension();

            // Create unique file name
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            // Refer image to method resizeImage
            $save = $this->resizeImage($file, $fileNameToStore, $request,$final);
 
     
    }

    public function resizeImage($file, $fileNameToStore, $request,$final)
    {

    

        $date = date('Y-m');
        $folder_name = str_replace(':', '', $date);
        $name = $request->get('name');
  
        $attributes = [

            'imageable_id'      => $final['able_id'],
            'imageable_type'    => $final['able_type'],

            'name'              => null,
            'file_name'         => null,
            'featured'          => false,
            'mime_type'         => null,
            'remarks'           => $request->get('remarks'),
            'sort_by'           => $request->get('sort_by'),
            'is_active'         => 'Yes',
        ];
        $sizes = [
            'small' => [100, 100],
            'medium' => [780, 780],
            'full' => [1020, 1020],
            'thumbnail' => [300, 300],
        ];


        foreach ($sizes as $key => $size) {
            // Resize image
            $resize = Image::make($file)->fit($size[0], $size[1])->encode('jpg');
            // Create hash value
            $hash = md5($resize->__toString());
            // Prepare qualified image name
            $image = $hash . "jpg";
            // Put image to storage
            $save = Storage::put("public/dropzon/{$folder_name}/{$key}/{$fileNameToStore}", $resize->__toString());

            if ($save) {
                $attributes[$key] = "dropzon/{$folder_name}/{$key}/{$fileNameToStore}";
            }
        }


        // dd($attributes);
        $insert = MemberPicture::create($attributes);
        return $insert->id;

    }
}
