<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect(string $shortLink)
    {
        $link = Link::where('shortLink', $shortLink)->first();

        if ($link) {
            $originalLink = $link->getOriginalLink();
            return $originalLink;
        } else {
            return 'There are no URLs saved for the shortened link';
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'originalLink' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->all();

        $shortLink = Str::random(8);

        $link = Link::create([
            'originalLink' => $data['originalLink'],
            'shortLink' => $shortLink,
        ]);

        return response()->json(['message' => 'Ссылка успешно создана' , 'shortLink' => $link->getShortLink()], 201);
    }
}
