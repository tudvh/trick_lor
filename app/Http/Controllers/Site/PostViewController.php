<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\PostView;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostViewController extends Controller
{
    private function randomDateTime()
    {
        $startDate = Carbon::create(2023, 9, 30);
        $endDate = Carbon::create(2024, 1, 29);

        $randomDateTime = Carbon::createFromTimestamp(mt_rand($startDate->timestamp, $endDate->timestamp));

        return $randomDateTime->toDateTimeString();
    }

    public function test()
    {
        $userIds = [null, 2, 4, 5];

        for ($i = 1; $i <= 1000; $i++) {
            $dateTimeRand = $this->randomDateTime();

            $postView = new PostView();
            $postView->id = $i;
            $postView->user_id = $userIds[array_rand($userIds)];
            $postView->post_id = mt_rand(1, 16);
            $postView->created_at = $dateTimeRand;
            $postView->updated_at = $dateTimeRand;
            $postView->save();
        }

        $postViews = PostView::oldest('created_at')->get();

        foreach ($postViews as $index => $postView) {
            $postView->id = $index + 9999;
            $postView->save();
        }

        foreach ($postViews as $index => $postView) {
            $postView->id = $index + 1;
            $postView->save();
        }

        $postViews = PostView::oldest('created_at')->pluck('id')->toArray();
        dd($postViews);
    }
}
