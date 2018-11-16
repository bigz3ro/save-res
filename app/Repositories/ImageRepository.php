<?php

namespace App\Repositories;
use Image;
use Illuminate\Http\Request;
use Validator;

class ImageRepository
{
    public function scrape($url, $maxWidth, $filename = null, $folder = '')
    {
        try {
            $image = Image::make($url)->encode('jpg', 100);
            if ($image->width() > $maxWidth) {
                $image->resize($maxWidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            if (empty($filename)) {
                $filename = md5(time()) . '-' . uniqid() . '.jpg';
            }
            $targetFile = env('STATIC_UPLOAD_PATH', public_path('static')) . '/' . $folder . $filename;
            if ($image->save($targetFile, 100)) {
                return [
                    'status' => 'success',
                    'data'   => [
                        'url' => env('STATIC_HTTP_ROOT') . '/' .  $folder . $filename,
                        'name' => $filename,
                    ],
                ];
            }
        } catch (\Exception $e) {
            \Log::error($e->getCode().' - '.$e->getMessage()."\r\n".$e->getTraceAsString());
        }
        return [
            'status' => 'error',
            'message'  => 'Đã có lỗi xảy ra, vui lòng thử lại.',
        ];
    }

    public function upload(Request $request, $name, $maxWidth, $filename = null, $folder = '')
    {

        $validator = Validator::make($request->all(),[
            $name => 'required|image|mimes:gif,jpeg,jpg,png,bmp|max:5120',
        ], [
            "{$name}.image"    => 'File upload phải là ảnh',
            '{$name}.mimes'    => 'File upload phải là tệp thuộc dạng: gif, jpeg, jpg, png, bmp.',
            '{$name}.max'      => 'File upload phải có dung lượng nhỏ hơn 5MB',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'error',
                'message'  => $validator->messages()->first(),
            ];
        }
        $file = $request->file($name);
        $image = Image::make($file)->encode('jpg', 100);
        if (empty($filename)) {
            $filename = md5(time()) . '-' . uniqid() . '.jpg';
        }

        try {
            if ($image->width() > $maxWidth) {
                $image->resize($maxWidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $targetFile = public_path('static') . '/' . $folder . $filename;
            if ($image->save($targetFile, 100)) {
                return [
                    'status' => 'success',
                    'data'   => [
                        'url' => env('STATIC_HTTP_ROOT') . '/' . $folder . $filename,
                        'name' => $filename,
                    ],
                ];
            }
        } catch (\Exception $e) {
            dd($e);
            \Log::error($e->getCode().' - '.$e->getMessage()."\r\n".$e->getTraceAsString());
        }
        return [
            'status' => 'error',
            'message'  => 'Đã có lỗi xảy ra, vui lòng thử lại.',
        ];
    }
}
