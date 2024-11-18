<?php

namespace NewCo\UserService\Controllers;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use NewCo\UserService\Repositories\PhotoRepository;

class UploadController
{
    /**
     * Accept an image upload, extract data from the upload, and pass the image to
     * localhost:4000 for storage.
     */
    public function upload(Request $request): Response
    {
        // TODO
        $method = $request->getMethod();
        if ($request->isMethod('GET')) {
            return render('upload.view');
        }
        if ($request->isMethod('POST')) {
            $file = $request->files->get('image');
            if ($file) {
                // file exists
                $fileTempPath = $file->getPathname();
                $fileName = $file->getClientOriginalName();
                $fileSize = $file->getSize();
                $mimeType = $file->getClientMimeType();
                if (str_starts_with($mimeType, 'image/')) {
                    // file is image
                    $fileInfo = getimagesize($fileTempPath);
                    if (function_exists('exif_read_data')) {
                        $exif = exif_read_data($fileTempPath);
                    }
                    $metadata = [
                        "file_name" => $fileName,
                        "file_size" => $fileSize,
                        "mime_type" => $mimeType,
                        "image_width" => $fileInfo[0],
                        "image_height" => $fileInfo[1],
                        "image_bits" => $fileInfo['bits'],
                        "image_channels" => $fileInfo['channels'],
                        "exif" => $exif ?? false
                    ];
                    $jsonMetadata = json_encode($metadata, JSON_PRETTY_PRINT);

                    //save file metadata to db
                    $success = (new PhotoRepository())->addPhoto($fileName, $jsonMetadata);
                    if ($success) {
                        //send image to file_storage_service
                        $client = new Client();
                        $response = $client->post('http://localhost:4000/save', [
                            'multipart' => [
                                [
                                    'name' => 'image',
                                    'contents' => fopen($fileTempPath, 'r'),
                                    'filename' => $fileName
                                ],
                            ],
                        ]);

                        if ($response->getStatusCode() == 200) {
                            return render('upload.view', ['success' => true, 'fileName' => $fileName, 'metadata' => $jsonMetadata]);
                        }
                        return new Response($response->getBody());

                    }
                    return new Response(
                        "Error! File failed to be added to the DB.<br>File Name: $fileName<br>Metadata:<br><pre>$jsonMetadata</pre>",
                    );

                }
                return new Response("Error! File type not supported", Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }
        return new Response("Error! Invalid Method.<br>Method: $method", Response::HTTP_METHOD_NOT_ALLOWED);
    }

}
