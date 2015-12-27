<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use App\Models\Settings as SettingsModel;

class Settings extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function getCollectionNames()
    {
        return view('json', [
            'data' => (new SettingsModel)->getCollectionNames(),
        ]);
    }

    /**
     * @param string $collectionName
     * @return \Illuminate\View\View
     */
    public function getCollectionFields($collectionName)
    {
        return view('json', [
            'data' => (new SettingsModel)->getCollectionFields($collectionName),
        ]);
    }

    /**
     * @param string $collectionName
     * @return \Illuminate\View\View
     */
    public function createCollection($collectionName)
    {
        return view('json', [
            'data' => ['status' => (new SettingsModel)->createCollection($collectionName)],
        ]);
    }

    /**
     * @param string $collectionName
     * @return \Illuminate\View\View
     */
    public function deleteCollection($collectionName)
    {
        return view('json', [
            'data' => [
                'status' => (new SettingsModel)->deleteCollection($collectionName),
                'url' => '/settings',
            ],
        ]);
    }

    /**
     * @param Request $request
     * @param string $collectionName
     * @return \Illuminate\View\View
     */
    public function editCollection(Request $request, $collectionName)
    {
        $settings = new SettingsModel;
        if (!empty($request->newCollectionName) && $dbName = env('DB_DATABASE', '')) {
            $newCollectionName = $request->newCollectionName;
            if ($settings->renameCollection($dbName, $collectionName, $newCollectionName)) {
                return view('json', [
                    'data' => [
                        'status' => false,
                        'errors' =>
                            $settings->isError() ?
                                $settings->getErrors() :
                                "Collection rename error (from [$collectionName] to [$newCollectionName]).",
                    ],
                ]);
            }
            $collectionName = $newCollectionName;
        }

        return view('json', [
            'data' => [
                'status' => $settings->editDocument($collectionName, $request->id, $request->fields),
                'url' => "/settings/$collectionName",
                'errors' => $settings->isError() ? $settings->getErrors() : NULL,
            ],
        ]);
    }
}