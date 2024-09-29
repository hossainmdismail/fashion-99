<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Photo;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = Campaign::all();
        return view('backend.campaign.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.campaign.create_campaign');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'campaign_for'      => 'required|max:255',
            'campaign_name'     => 'required|max:255',
            'campaign_image'    => 'required',
            'target'            => 'required',
            's_price'           => 'required',
            'sp_type'           => 'required',
        ]);

        $size = null;

        // if ($request->image_type == 'horizontal') {
        Photo::upload($request->campaign_image, 'files/campaign', 'CAMP', [966, 542]);
        // } elseif ($request->image_type == 'vertical') {
        //     Photo::upload($request->campaign_image, 'files/campaign', 'CAMP', [600, 712]);
        // }
        Campaign::insert([
            'campaign_for'      => $request->campaign_for,
            'campaign_name'     => $request->campaign_name,
            'campaign_image'    => Photo::$name,
            'type'              => 'campaign',
            'target'           => $request->target,
            'sp_type'           => $request->sp_type,
            's_price'           => $request->s_price,
            'start'             => $request->start,
            'end'               => $request->end,
            'created_at'        => Carbon::now(),
        ]);
        return back()->with('succ', 'Campaign added...');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $request = Campaign::find($id);

        return view('backend.campaign.campaign_edit', compact('request'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'campaign_name' => 'required|max:255',
            'sp_type'       => 'required',
            'target'        => 'required',
            's_price'       => 'required',
        ]);


        $campaign = Campaign::find($id);
        $campaign->campaign_for     = $request->campaign_for;
        $campaign->campaign_name    = $request->campaign_name;
        $campaign->start            = $request->start;
        $campaign->target           = $request->target;
        $campaign->end              = $request->end;
        $campaign->sp_type          = $request->sp_type;
        $campaign->s_price          = $request->s_price;

        if ($request->campaign_image) {
            $request->validate([
                'campaign_image'    => 'required',
            ]);

            Photo::delete('files/campaign', $campaign->campaign_image);
            Photo::upload($request->campaign_image, 'files/campaign', 'CAMP');
            $campaign->campaign_image  = Photo::$name;
        }

        $campaign->save();
        return back()->with('succ', 'Campaign Updated...');
    }

    public function destroy(string $id)
    {
        $campaign = Campaign::find($id);
        if ($campaign->campaign_image) {
            Photo::delete('files/campaign', $campaign->campaign_image);
        }
        $campaign->delete();
        return back();
    }
}
