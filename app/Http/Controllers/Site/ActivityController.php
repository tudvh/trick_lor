<?php

namespace App\Http\Controllers\Site;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\Site\PostSaveService;
use App\Services\Site\PostViewService;

class ActivityController extends Controller
{
    protected $postViewService;
    protected $postSaveService;

    public function __construct(PostViewService $postViewService, PostSaveService $postSaveService)
    {
        $this->middleware('site');

        $this->postViewService = $postViewService;
        $this->postSaveService = $postSaveService;
    }

    public function view()
    {
        $userId = Auth::guard('site')->user()->id;
        $postViews = $this->postViewService->getByUserId($userId);

        $postViewsGroup = $postViews->groupBy(function ($postView) {
            return Carbon::parse($postView->created_at)->format('d-m-Y');
        });

        $postViewsGroup = $postViewsGroup->map(function ($group) {
            return $group->groupBy('post_id')->map(function ($postView) {
                return $postView->first();
            });
        });

        // $postViewsGroup = $postViewsGroup->map(function ($group) {
        //     $ids = [];

        //     return $group->filter(function ($postView) use (&$ids) {
        //         if (in_array($postView->post_id, $ids)) {
        //             return false;
        //         }

        //         $ids[] = $postView->post_id;
        //         return true;
        //     });
        // });

        return view('pages.site.activities.view', compact('postViews', 'postViewsGroup'));
    }

    public function save()
    {
        $userId = Auth::guard('site')->user()->id;
        $postSaves = $this->postSaveService->getByUserId($userId);

        return view('pages.site.activities.save', compact('postSaves'));
    }
}
