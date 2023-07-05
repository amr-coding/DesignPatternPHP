<?php



// class ImageProcessor
// {
//     private $taskId;

//     public function __construct($taskId)
//     {
//         $this->taskId = $taskId;
//     }

//     public function process($imagePath)
//     {
//         // Simulate image processing task
//         echo "Processing Task {$this->taskId}: $imagePath" . PHP_EOL;
//         // Original image path
//         $originalImagePath = [];
//         foreach (glob("*.jpg") as $key => $filename) {
//             array_push($originalImagePath, $filename);
//         }
//         // New image dimensions
//         $newWidth = 800;
//         $newHeight = 600;

//         // Load the original image
//         foreach ($originalImagePath as $key => $image) {
//             $originalImage = imagecreatefromjpeg($image);
//             // Create a new blank image with the desired dimensions
//             $newImage = imagecreatetruecolor($newWidth, $newHeight);
//             imagecopyresampled(
//                 $newImage,
//                 $originalImage,
//                 0,
//                 0,
//                 0,
//                 0,
//                 $newWidth,
//                 $newHeight,
//                 imagesx($originalImage),
//                 imagesy($originalImage)
//             );
//             $resizedImagePath = 'resized' . $key + 1  . '.jpg';
//             imagejpeg($newImage, $resizedImagePath);
//             imagedestroy($originalImage);
//             imagedestroy($newImage);
//         }



//         echo "Image resized and saved successfully.";
//         echo "Task {$this->taskId} completed." . PHP_EOL;
//     }
// }

// class ImageProcessingPool
// {
//     private $pool;
//     private $maxSize;

//     public function __construct($maxSize)
//     {
//         $this->maxSize = $maxSize;
//         $this->pool = new SplQueue();
//     }

//     public function getProcessor()
//     {
//         if (!$this->pool->isEmpty()) {
//             return $this->pool->dequeue();
//         } elseif (count($this->pool) < $this->maxSize) {
//             return $this->createProcessor();
//         } else {
//             throw new Exception('Processing pool limit exceeded.');
//         }
//     }

//     public function releaseProcessor($processor)
//     {
//         $this->pool->enqueue($processor);
//     }

//     private function createProcessor()
//     {
//         $taskId = count($this->pool) + 1;
//         return new ImageProcessor($taskId);
//     }
// }

// // Usage example
// $poolSize = 3;
// $processingPool = new ImageProcessingPool($poolSize);

// try {
//     $processor1 = $processingPool->getProcessor();
//     $processor2 = $processingPool->getProcessor();
//     $processor3 = $processingPool->getProcessor();

//     $image1 = 'image1.jpg';
//     $image2 = 'image2.jpg';
//     $image3 = 'image3.jpg';

//     $processor1->process($image1);
//     $processor2->process($image2);
//     $processor3->process($image3);

//     $processingPool->releaseProcessor($processor1);
//     $processingPool->releaseProcessor($processor2);
//     $processingPool->releaseProcessor($processor3);

//     $processor4 = $processingPool->getProcessor();
//     $processor4->process($image1);

//     $processingPool->releaseProcessor($processor4);
// } catch (Exception $e) {
//     echo 'Error: ' . $e->getMessage();
// }


class ImageProcessor
{
    private $taskId;

    public function __construct($taskId)
    {
        $this->taskId = $taskId;
    }

    public function process($originalImagePath, $resizedImagePath, $newWidth, $newHeight)
    {
        $originalImage = imagecreatefromjpeg($originalImagePath);
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled(
            $newImage,
            $originalImage,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            imagesx($originalImage),
            imagesy($originalImage)
        );
        imagejpeg($newImage, $resizedImagePath);
        imagedestroy($originalImage);
        imagedestroy($newImage);

        // echo "Image resized and saved: $resizedImagePath" . PHP_EOL;
    }
}

class ImageProcessingPool
{
    private $pool;
    private $maxSize;

    public function __construct($maxSize)
    {
        $this->maxSize = $maxSize;
        $this->pool = new SplQueue();
    }

    public function processImages($originalImagePaths, $newWidth, $newHeight)
    {
        $processedImages = [];

        foreach ($originalImagePaths as $key => $originalImagePath) {
            $resizedImagePath = 'resized' . ($key + 1) . '.jpg';

            $processor = $this->getProcessor();
            $processor->process($originalImagePath, $resizedImagePath, $newWidth, $newHeight);
            $processedImages[] = $resizedImagePath;

            $this->releaseProcessor($processor);
        }

        return $processedImages;
    }

    public function getProcessor()
    {
        if (!$this->pool->isEmpty()) {
            return $this->pool->dequeue();
        } elseif (count($this->pool) < $this->maxSize) {
            return $this->createProcessor();
        } else {
            throw new Exception('Processing pool limit exceeded.');
        }
    }

    public function releaseProcessor($processor)
    {
        $this->pool->enqueue($processor);
    }

    private function createProcessor()
    {
        $taskId = count($this->pool) + 1;
        return new ImageProcessor($taskId);
    }
}

$originalImagePath = [];
foreach (glob("*.jpg") as $filename) {
    $originalImagePath[] = $filename;
}

$newWidth = 800;
$newHeight = 600;

$poolSizes = [1, 2]; // Different pool sizes to test

foreach ($poolSizes as $poolSize) {
    $filesToDelete = glob('*resized*.jpg');

    if (!empty($filesToDelete)) {
        foreach ($filesToDelete as $file) {
            unlink($file);
            // echo "Deleted file: $file" . PHP_EOL;
        }
    } else {
        echo "No files to delete." . PHP_EOL;
    }
    $processingPool = new ImageProcessingPool($poolSize);

    $startTime = microtime(true);

    $processedImages = $processingPool->processImages($originalImagePath, $newWidth, $newHeight);

    $endTime = microtime(true);
    $executionTime = $endTime - $startTime;

    echo "Images processed with pool size $poolSize in $executionTime seconds." . "<br>";
}
