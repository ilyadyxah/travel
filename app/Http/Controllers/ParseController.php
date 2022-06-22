<?php

namespace App\Http\Controllers;

use App\Http\Requests\Source\CreateRequest;
use App\Jobs\PlaceParseJob;
use App\Models\City;
use App\Models\Group;
use App\Models\Image;
use App\Models\Place;
use App\Models\Source;
use App\Models\Transport;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;
use function PHPUnit\Framework\isEmpty;

class ParseController extends \Illuminate\Routing\Controller
{
    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function parse(CreateRequest $request)
    {
        $inputData = $request->validated();

        $source = Source::find($inputData['source-id']);

        for ($i = 0; $i < $inputData['count']; $i++) {
            PlaceParseJob::dispatch($source)->onQueue('parse');

        }


        return redirect()->route('account.profile' )->with([
            'success'=> __('messages.account.places.parsed.success'),
            'item' => $inputData['count'] . ' мест',
        ]);
    }

}
