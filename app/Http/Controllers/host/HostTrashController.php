<?php

namespace App\Http\Controllers\host;

use App\Models\Show;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Episode;

class HostTrashController extends Controller
{
    public function index()
    {
        return view('host.trash.index');
    }

    public function restoreShow(string $id)
    {
        $show = Show::onlyTrashed()
                ->where('id', $id)->first();

        if (!$show) {
            toast()
                ->warning('No show found !')
                ->pushOnNextPage();

            return redirect(route('host.trash'));
        }

        $show->restore();

        toast()
            ->success($show->title. ' restored successfully')
            ->pushOnNextPage();

        return redirect(route('host.trash'));
    }

    public function restoreEpisode(string $id)
    {
        $episode = Episode::onlyTrashed()
            ->where('id', $id)->first();

        if (!$episode) {
            toast()
                ->warning('No show found !')
                ->pushOnNextPage();

            return redirect(route('host.trash'));
        }

        $episode->restore();

        toast()
            ->success($episode->title . ' restored successfully')
            ->pushOnNextPage();

        return redirect(route('host.trash'));
    }

    public function deleteShow($id)
    {
        $show = Show::onlyTrashed()
            ->where('id', $id)->first();

        if (!$show) {

            toast()
                ->warning('No show found !')
                ->pushOnNextPage();

            return redirect(route('host.trash'));
        }

        $show->forceDelete();

        toast()
            ->success('show deleted successfully')
            ->pushOnNextPage();

        return redirect(route('host.trash'));
    }

    public function deleteEpisode($id)
    {
        $episode = Episode::onlyTrashed()
            ->where('id', $id)->first();

        if (!$episode) {

            toast()
                ->warning('No show found !')
                ->pushOnNextPage();

            return redirect(route('host.trash'));
        }

        $episode->forceDelete();

        toast()
            ->success('show deleted successfully')
            ->pushOnNextPage();

        return redirect(route('host.trash'));
    }
}
