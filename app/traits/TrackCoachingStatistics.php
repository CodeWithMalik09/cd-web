<?php
namespace App\traits;

use App\Models\CoachingStatistics;

trait TrackCoachingStatistics
{
    public function coachingView($coaching_id)
    {
        $stats = CoachingStatistics::where('coaching_id', $coaching_id)->get();
        if ($stats->count() == 1) {
            CoachingStatistics::where('coaching_id', $coaching_id)->increment('views');
        } else {
            CoachingStatistics::create(
                [
                    'coaching_id' => $coaching_id,
                    'views' => 1
                ]
            );
        }

        return 1;
    }
}


?>