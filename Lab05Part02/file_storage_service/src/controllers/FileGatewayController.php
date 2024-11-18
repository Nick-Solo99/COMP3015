<?php

namespace NewCo\FileGateway\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FileGatewayController
{
    /**
     * Accept an image, and save it to the images/ directory on disk.
     */
    public function save(Request $request): Response
    {
        // TODO
        if (!$request->files->has('image')) {
            return new Response('No file uploaded', Response::HTTP_BAD_REQUEST);
        }

        $file = $request->files->get('image');
        if (!$file) {
            return new Response('invalid file', Response::HTTP_BAD_REQUEST);
        }

        $uploadDir = __DIR__ . '/../../images/';
        $fileName = $file->getClientOriginalName();
        $file->move($uploadDir, $fileName);


        return new Response('File uploaded', Response::HTTP_OK);
    }

}
