<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HuntController extends Controller
{
    /**
     * Show hunts for this date
     *
     * @param Request $request
     * @return view
     */
    public function get(Request $request)
    {
        //-- Get date we are hunting
        $date = $request->input('d', date("Y-m-d"));

        //-- TODO validation

        //-- Get data
        $hunts = (new \App\Action\Hunt)->getDate($date);

        //-- Return view
        return view('page', [
            'hunts' => $hunts['posts'],
            'date' => $date,
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function test(Request $request)
    {
        $url = $request->input('url');
        $resp = (new \App\Action\Hunt)->canFollowRedirect($url);
        return response()->json([
            'success' => $resp,
        ]);
    }
}
