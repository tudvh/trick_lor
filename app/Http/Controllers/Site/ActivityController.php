<?php

namespace App\Http\Controllers\Site;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
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
        })->map(function ($group) {
            return $group->groupBy('post_id')->map->first();
        });

        $perPage = 5;
        $totalGroups = $postViewsGroup->count();
        $page = request()->get('page', 1);

        $slicedGroups = $postViewsGroup->slice(($page - 1) * $perPage, $perPage)->all();

        $postViewsPaginator = new LengthAwarePaginator(
            $slicedGroups,
            $totalGroups,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('pages.site.activities.view', compact('postViewsPaginator'));
    }

    public function save()
    {
        $userId = Auth::guard('site')->user()->id;
        $postSaves = $this->postSaveService->getByUserId($userId);

        $postSavesGroup = $postSaves->groupBy(function ($postSave) {
            return Carbon::parse($postSave->created_at)->format('d-m-Y');
        })->map(function ($group) {
            return $group->groupBy('post_id')->map->first();
        });

        $perPage = 5;
        $totalGroups = $postSavesGroup->count();
        $page = request()->get('page', 1);

        $slicedGroups = $postSavesGroup->slice(($page - 1) * $perPage, $perPage)->all();

        $postSavesPaginator = new LengthAwarePaginator(
            $slicedGroups,
            $totalGroups,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('pages.site.activities.save', compact('postSavesPaginator'));
    }
}
