<?php
namespace App\traits;

use App\Models\LibraryStatistics;

trait TrackLibraryStatistics
{
    public function libraryView($library_id)
    {
        $stats = LibraryStatistics::where('library_id', $library_id)->get();
        if ($stats->count() == 1) {
            LibraryStatistics::where('library_id', $library_id)->increment('views');
        } else {
            LibraryStatistics::create(
                [
                    'library_id' => $library_id,
                    'views' => 1
                ]
            );
        }

        return 1;
    }
}


?>