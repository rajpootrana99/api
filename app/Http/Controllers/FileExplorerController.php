<?php

namespace App\Http\Controllers;


use DateTime;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Str;


class FileExplorerController extends Controller
{
    protected $disk;
    protected $globalPath = "app/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentPath = $request->input("path", "explorer");
        // print_r(array($this->fetchFileFolders()->getData()));
        // die;

        // $files = json_decode($this->fetchFileFolders($currentPath)->getContent());
        $response =  view("explorer.index", compact("currentPath"));

        return response($response);
    }



    // SEARCHING or GETTING ALL DIRECTORIES AND FILES IN CURRENT DIRECTORY
    public function getFileFolders(Request $request)
    {
        $currentPath = $request->input("path", "explorer");
        $query = $request->input("search", "");

        if (strlen($query["value"]) == 0)   $fileFolders = $this->fetchFileFolders($currentPath, false);
        else $fileFolders = $this->fetchFileFolders($currentPath, true);



        // $path = "explorer\\pictures";
        // echo ($path)."<br>".storage_path($path)."<br>";

        $response = [];
        $data = [];

        $recordsTotal = sizeof($fileFolders);
        $recordsFiltered = 0;




        // $index = ;
        for ($i = 0; $i < $recordsTotal; $i++) {
            $file = $fileFolders[$i];

            $searchName = $this->isDir($file) ? $this->getFolderName($file) : File::name($file) . "." . File::extension($file);
            $type = $this->isDir($file) ? "File Folder" : Str::upper(File::extension($file)) . " File";
            $dateModified = $this->getTimeToDate(filemtime(storage_path($this->globalPath . $file)));
            $size = $this->isDir($file) ? "" : $this->getSizeAbbrev(Storage::size($file));

            // echo $searchName."<br>".str_contains($searc, $searchName)."<br>";
            if (Str::contains($searchName, $query["value"], true) || Str::contains($type, $query["value"], true) || Str::contains($size, $query["value"], true) || str_contains($dateModified, $query["value"])) {
                // if( $index == ((int)($request->input("start")) + (int)($request->input("length"))) )

                $temp = [
                    "fileRoute" => $this->isDir($file) ? $file : route("explorer.download", base64_encode($file)),
                    "viewRoute" => $this->isDir($file) ? $file : route("explorer.getOrView", base64_encode($file)),
                    "encodedRoute" => base64_encode($file),
                    "path" => $file,
                    "name" => $searchName,
                    "ifFileCount" => $this->isDir($file) ? (sizeof(Storage::files($file)) + sizeof(Storage::directories($file))) : 0,
                    "size" => $size,
                    "type" => $type,
                    "dateModified" => $dateModified,
                    "searchResult" => strlen($query["value"]) > 0 ? "true" : "false",
                ];


                ++$recordsFiltered;

                $data[] = $temp;

                // ++$index;
            }
        }
        $response["draw"] = $request->input("draw");
        $response["recordsTotal"] = $recordsTotal;
        $response["recordsFiltered"] = $recordsTotal;
        $response["data"] = $data;

        return response()->json($response);
    }

    public static function getFileLink($host, $file)
    {
        $encoded_path = base64_encode("app/" . $file);
        return $host . "/getOrView/" . $encoded_path;
    }

    public function getOrView(Request $request, $file = "Dasda")
    {
        // $file = $request->input("file",null);
        echo $file;
        $file = base64_decode($file);
        // return $file;
        // $file = s;
        // $file[strlen($file)-1] = "";
        $FILE = File::get(storage_path($this->globalPath . $file));

        // die;
        ob_end_clean();

        return response()->make($FILE, 200, [
            "Content-Type" => File::mimeType(storage_path($this->globalPath . $file)),
            "Content-Length" => File::size(storage_path($this->globalPath. $file))
        ]);
        // $fileName = File::name($file) . "." . File::extension($file);
        // return response(storage_path($this->globalPath . $file));
        // return response(storage_path($this->globalPath . $file), 200, [
        //     "Content-Type" => File::mimeType(storage_path($this->globalPath . $file)),
        //     // 'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        //     // 'Content-Length' => filesize(storage_path($this->globalPath . $file)),
        // ]);
        // return response()->download();
    }

    public function download(Request $request, $file = "Dasda")
    {
        // $file = $request->input("file",null);
        echo $file;
        $file = base64_decode($file);

        // $file = s;
        // $file[strlen($file)-1] = "";
        echo storage_path($this->globalPath . $file);

        // die;
        ob_end_clean();

        $fileName = File::name($file) . "." . File::extension($file);
        return response()->download(storage_path($this->globalPath . $file), $fileName, [
            "Content-Type" => File::mimeType(storage_path($this->globalPath . $file)),
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Content-Length' => filesize(storage_path($this->globalPath . $file)),
        ]);
    }

    public function deleteFileFolder(Request $request)
    {
        $file = $request->input('file', null);
        if($file == null){
            $file = $request->input("key", null);
            if($file == null){
                return;
            }
        }
        $file = base64_decode($file);

        $response = null;
        try {
            $response = $this->isDir($file) ? File::deleteDirectory(storage_path($this->globalPath . $file)) : File::delete([storage_path($this->globalPath . $file)]);
        } catch (Exception $e) {
            return "false";
        }

        return $response ? "true" : "false";
    }

    public function createFolder(Request $request)
    {
        $name = $request->input('name');
        $path = $request->input('path');
        // $file = base64_decode($file);

        $response = false;
        try {
            if (!File::exists(storage_path($this->globalPath . $path . "/" . $name)))
                $response = File::makeDirectory(storage_path($this->globalPath . $path . "/" . $name));
        } catch (Exception $e) {
            return "false";
        }

        return $response ? "true" : "false";
    }

    public function createEntity($entity)
    {
        $entityPath = "explorer";
        $createRequest = new Request(["path" => $entityPath, "name" => $entity]);
        if ($this->createFolder($createRequest) == "true") //returns true if created otherwise false as string
        {
            $relativeEntityPath = $entityPath . "/" . $entity;

            $this->createFolder(new Request(["path" => $relativeEntityPath, "name" => "Documentation"]));
            $this->createFolder(new Request(["path" => $relativeEntityPath, "name" => "Correspondence"]));
            // $this->createFolder(new Request([ "path" => $relativeEntityPath , "name" => "Sites"]));
            return "true";
        }
        return "false";
    }

    // public function createClient($entity, $user)
    // {
    //     $clientPath = "explorer/".$entity."/Correspondence";
    //     $createRequest = new Request([ "path" => $clientPath , "name" => $user]);

    //     return $this->createFolder($createRequest); //returns true if created otherwise false as string;
    // }

    public function createSite($entity, $site)
    {
        $sitePath = "explorer/" . $entity;
        $createRequest = new Request(["path" => $sitePath, "name" => $site]);
        if ($this->createFolder($createRequest) == "true") //returns true if created otherwise false as string
        {
            $siteAbsolutePath = $sitePath . "/" . $site;
            $this->createFolder(new Request(["path" => $siteAbsolutePath, "name" => "Images"]));
            $this->createFolder(new Request(["path" => $siteAbsolutePath, "name" => "Plans"]));
            $this->createFolder(new Request(["path" => $siteAbsolutePath, "name" => "Safety"]));
            // $this->createFolder(new Request([ "path" => $siteAbsolutePath , "name" => "Tasks"]));
        }
        return "false";
    }

    public function createTask($entity, $site, $task)
    {
        $taskPath = "explorer/" . $entity . "/" . $site;
        $createRequest = new Request(["path" => $taskPath, "name" => $task]);
        if ($this->createFolder($createRequest) == "true") //returns true if created otherwise false as string
        {
            $taskAbsolutePath = $taskPath . "/" . $task;
            $this->createFolder(new Request(["path" => $taskAbsolutePath, "name" => "Images"]));
            $this->createFolder(new Request(["path" => $taskAbsolutePath, "name" => "Orders"]));
            $this->createFolder(new Request(["path" => $taskAbsolutePath, "name" => "Safety"]));
        }
        return "false";
    }

    // public function createEnquiry($entity, $site, $enquiry)
    // {
    //     $enquiryPath = "explorer/".$entity."/".$site."/Enquiries";
    //     $createRequest = new Request([ "path" => $enquiryPath , "name" => $enquiry]);
    //     return $this->createFolder($createRequest); //returns true if created otherwise false as string
    // }

    // public function createJob($entity, $site, $job)
    // {
    //     $jobPath = "explorer/".$entity."/".$site."/Jobs";
    //     $createRequest = new Request([ "path" => $jobPath , "name" => $job]);
    //     return $this->createFolder($createRequest); //returns true if created otherwise false as string
    // }

    public function getUploadFolderInfo(Request $request, string $file)
    {
        $file = base64_decode($file);

        // echo $file;
        //putting dummy data return owner , document group, revision, revision date, folder path and other data
        $response = [
            "uploadFolderPath" => base64_encode($file), //this is actual folder where the files will be uploaded
            "owner" => ["Insite Building Group", "Twin Site", "Char Site"],
            "group" => ["DOCUMENTS/ORDER", "DOCUMENTS/BUDGET", "DOCUMENTS/SPECS"],
            "status" => ["Applicable", "Not Applicable"],
            "folder" => ["Plans/Budget", "Plans/Specs"],
        ];

        return response()->json($response);
    }

    public function uploadFiles(Request $request)
    {
        $uploadPath = base64_decode($request->input("uploadFolderPath"));
        $files = $request->file("uploadFiles");


        foreach ($files as $file) {
            $file->move(storage_path($this->globalPath . $uploadPath), $file->getClientOriginalName());
        }

        return "true";

        // print_r($request);
    }

    // Kerajee File Input GET IMAGES Asynchronously
    public function kerajeeGetImages(Request $request)
    {
        $folderPath = base64_decode($request->input("uploadFolderPath"));

        $initialPreview = [];
        $initialPreviewConfig = [];

        $files = Storage::files($folderPath);
        foreach ($files as $file) {
            if(! Str::of(strtolower(File::extension($file)))->test("/((png)|(jpg)|(jpeg)|(gif))/")) continue;

            $filePath = base64_encode( $file );
            $fileName = File::name($file) . "." . File::extension($file);
            $fileSize = Storage::size($file);
            $fileViewLink = route("explorer.getOrView", $filePath);
            $fileDeleteLink = route("explorer.delete");


            $initialPreview[] = $fileViewLink;
            $initialPreviewConfig[] = [
                "caption" => $fileName,
                "size" => $fileSize,
                "url" => $fileDeleteLink,
                "downloadUrl" => $fileViewLink,
                "key" => $filePath,
                "exif" => null
            ];
        }

        return response()->json([
            "initialPreview" => $initialPreview,
            "initialPreviewConfig" => $initialPreviewConfig,
            "initialPreviewAsData" => true
        ]);
    }
    // Kerajee File Input Upload Asynchronously
    public function kerajeeUploadImages(Request $request)
    {
        $uploadPath = base64_decode($request->input("uploadFolderPath"));
        $files = $request->file("uploadImages");


        $initialPreview = [];
        $initialPreviewConfig = [];
        $errors = [];
        foreach ($files as $file) {
            $filePath = base64_encode( $uploadPath."/".$file->getClientOriginalName() );
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $fileViewLink = route("explorer.getOrView", $filePath);
            $fileDeleteLink = route("explorer.delete");



            if(File::exists(storage_path($this->globalPath.$uploadPath."/".$file->getClientOriginalName())))
            {
                $errors[] = "File '$fileName' already exists.";
                break;
            }


            $initialPreview[] = $fileViewLink;
            $initialPreviewConfig[] = [
                "caption" => $fileName,
                "size" => $fileSize,
                "url" => $fileDeleteLink,
                "downloadUrl" => $fileViewLink,
                "key" => $filePath,
                "exif" => null
            ];
            // uploading file
            try {
                $file->move(storage_path($this->globalPath . $uploadPath), $file->getClientOriginalName());
            } catch (Exception $th) {
                $errors[] = "File '$fileName' upload failed.";
                break;
            }

        }

        return response()->json([
            "initialPreview" => $initialPreview,
            "initialPreviewConfig" => $initialPreviewConfig,
            "initialPreviewAsData" => true,
            "error" => $errors,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FileExplorer  $fileExplorer
     * @return \Illuminate\Http\Response
     */
    public function getEditData(Request $request)
    {
        $file = base64_decode($request->input("file"));
        // $file = base64_decode($file);


        $searchName = $this->isDir($file) ? $this->getFolderName($file) : File::name($file) . "." . File::extension($file);
        $parentPath = str_replace("/" . $searchName, "", $file);

        $temp = [
            "encodedRoute" => base64_encode($file),
            "path" => $file,
            "name" => $searchName,
            "type" => $this->isDir($file) ? "File Folder" : File::extension($file),
            "parentPath" => $parentPath,
            "isDir" => $this->isDir($file),

        ];

        return response()->json($temp);
    }

    // SAVE EDITED DATA
    public function saveEditedData(Request $request)
    {
        $name = $request->input("name");
        $isDir = $request->input("isDir");
        $type = $request->input("type");
        $path = $request->input("path");
        $oldParentPath = $request->input("oldParentFolderPath");
        $newParentPath = $request->input("newParentFolderPath");

        try {
            // if( $oldParentPath != $newParentPath )
            {
                if ($isDir) {
                    Storage::move($path, $newParentPath . "/" . $name);
                } else Storage::move($path, $newParentPath . "/" . $name . "." . $type);
            }
            return "true";
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return "false";
    }

    // GET FILE AND FOLDER JSON TREE
    public function getFolderTree(string $path = "explorer")
    {
        $response = $this->getRecursiveFolderStructure($path);

        return response()->json($response);
    }

    // recursively get tree
    private function getRecursiveFolderStructure(string $path)
    {
        $items = [];
        $directories = Storage::directories($path);

        foreach ($directories as $directory) {
            $items[] = [
                'id' => $directory,
                'text' => basename($directory),
                'icon' => "fa fa-folder",
                'children' => $this->getRecursiveFolderStructure($directory)
            ];
        }

        return $items;
    }


    // ROUTE FOR PROPERTIES
    // public function getProperties()
    // {
    // //     $response = [];

    // //     $index = 0;
    // //     foreach ($fileFolders as $file) {
    // //         $temp = [
    // //             "path" => $file,
    // //             "name" => $this->isDir($file) ? $this->getFolderName($file) : File::name($file).".".File::extension($file),
    // //             "ifFileCount" => $this->isDir($file) ? ( sizeof(Storage::files($file)) + sizeof(Storage::directories($file)) ) : 0,
    // //             "size" => $this->isDir($file) ? "" : $this->getSizeAbbrev(Storage::size($file)),
    // //             "type" => $this->isDir($file) ? "File Folder" : Str::upper(File::extension($file))." File",
    // //             "mimeType" => File::mimeType(storage_path($this->globalPath.$file)),
    // //             "dateModified" => $this->getTimeToDate(filemtime(storage_path($this->globalPath.$file))),
    // //             "dateCreated" => $this->getTimeToDate(filectime(storage_path($this->globalPath.$file))),
    // //             "dateAccessed" => $this->getTimeToDate(fileatime(storage_path($this->globalPath.$file))),
    // //         ];
    // //         $response[$index] = $temp;
    // //         $index++;
    // //     }

    //     // echo "<br>".json_encode($response, JSON_PRETTY_PRINT, 100);
    //     // die;

    //     // return response()->json($response);
    // }

    // FETCHING ALL DIRECTORIES AND FILES IN CURRENT DIRECTORY
    private function fetchFileFolders(string $path, bool $deep)
    {
        // $path = "explorer\\pictures";
        // echo ($path)."<br>".storage_path($path)."<br>";

        $fileFolders =  $deep ? array_merge(Storage::allDirectories($path), Storage::allFiles($path)) : array_merge(Storage::directories($path), Storage::files($path));

        return $fileFolders;
    }

    // IS DIRECTORY
    private function isDir($path)
    {
        return File::isDirectory(storage_path($this->globalPath . $path));
    }

    // IS FILE
    private function isFile($path)
    {
        return File::isFile(storage_path($this->globalPath . $path));
    }

    // FETCH FOLDER LAST MODIFIED TIME
    private function getTimeToDate($time)
    {
        $lastModified = $time;
        $date = new DateTime("@$lastModified");
        $date = $date->format("d-m-Y");
        return $date;
    }


    //get Folder Name
    private function getFolderName($path)
    {
        $folderNames = explode("/", $path);
        return $folderNames[count($folderNames) - 1];
    }

    // FETCH FOLDER SIZE WITH ALL FILES
    private function getFolderSize(string $path)
    {
        $files = Storage::allFiles($path);

        $folderSize = 0;
        foreach ($files as $file) {
            $folderSize += Storage::size($file);
        }

        return $folderSize;
    }

    // FETCH APPROPRIATE ABBREVIATION OF FILE FOLDER SIZE
    private function getSizeAbbrev($size_in_bytes)
    {
        if ($size_in_bytes < 1024) return $size_in_bytes . " Bytes"; // checking whether less than 1024 bytes
        elseif ($size_in_bytes < pow(1024, 2)) return round($size_in_bytes / pow(1024, 1), 2) . " KB"; //checking whether equal to an MB or not
        elseif ($size_in_bytes < pow(1024, 3)) return round($size_in_bytes / pow(1024, 2), 2) . " MB"; //checking whether equal to an GB or not
        elseif ($size_in_bytes < pow(1024, 4)) return round($size_in_bytes / pow(1024, 3), 2) . " GB"; //checking whether equal to an TB or not

        return round($size_in_bytes / pow(1024, 4), 2) . " TB"; //at last return in TB
    }





    // // SearchING ALL DIRECTORIES AND FILES IN CURRENT DIRECTORY
    // public function searchFileFolders(Request $request, $query)
    // {

    //     // $path = "explorer\\pictures";
    //     // echo ($path)."<br>".storage_path($path)."<br>";

    //     $fileFolders = array_merge(Storage::directories($path), Storage::files($path));

    //     $response = [];

    //     $index = 0;
    //     foreach ($fileFolders as $file) {
    //         $temp = [
    //             "path" => $file,
    //             "name" => $this->isDir($file) ? $this->getFolderName($file) : File::name($file).".".File::extension($file),
    //             "ifFileCount" => $this->isDir($file) ? ( sizeof(Storage::files($file)) + sizeof(Storage::directories($file)) ) : 0,
    //             "size" => $this->isDir($file) ? "" : $this->getSizeAbbrev(Storage::size($file)),
    //             "type" => $this->isDir($file) ? "File Folder" : Str::upper(File::extension($file))." File",
    //             "mimeType" => File::mimeType(storage_path($this->globalPath.$file)),
    //             "dateModified" => $this->getTimeToDate(filemtime(storage_path($this->globalPath.$file))),
    //             "dateCreated" => $this->getTimeToDate(filectime(storage_path($this->globalPath.$file))),
    //             "dateAccessed" => $this->getTimeToDate(fileatime(storage_path($this->globalPath.$file))),
    //         ];
    //         $response[$index] = $temp;
    //         $index++;
    //     }

    //     // echo "<br>".json_encode($response, JSON_PRETTY_PRINT, 100);
    //     // die;

    //     return response()->json($response);
    // }
}
