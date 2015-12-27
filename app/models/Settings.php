<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

class Settings
{
    protected $errors;

    /**
     * @return array
     */
    public function getCollectionNames()
    {
        return DB::getMongoDB()->getCollectionNames();
    }

    /**
     * @param string $collectionName
     * @return \MongoCollection
     */
    public function getCollectionFields($collectionName)
    {
        return DB::collection($collectionName)->get();
    }

    /**
     * @param string $collectionName
     * @return bool
     */
    public function createCollection($collectionName)
    {
        return (DB::getMongoDB()->createCollection($collectionName) instanceof \MongoCollection);
    }

    /**
     * @param string $collectionName
     * @return bool
     */
    public function deleteCollection($collectionName)
    {
        $dbResponse = DB::getMongoDB()->dropCollection($collectionName);

        return isset($dbResponse['ok']) ? (bool)$dbResponse['ok'] : false;
    }

    /**
     * @param string $collectionName
     * @param string $documentId
     * @param array $data - [key => val, ...]
     * @return bool
     */
    public function editDocument($collectionName, $documentId, $data)
    {
        $dbResponse = DB::collection($collectionName)
            ->where($documentId)
            ->update($data);

        return $this->checkResult($dbResponse);
    }

    /**
     * @param $dbName
     * @param $collectionName
     * @param $newCollectionName
     * @return bool
     */
    public function renameCollection($dbName, $collectionName, $newCollectionName)
    {
        $dbResponse = DB::getMongoClient()->admin->command([
            'renameCollection' => "$dbName.$collectionName",
            'to' => "$dbName.$newCollectionName",
        ]);

        return $this->checkResult($dbResponse);
    }

    /**
     * @param mixed $error
     */
    protected function setErrors($error)
    {
        $this->errors[] = is_string($error) ? $error : print_r($error, true);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    public function clearErrors()
    {
        $this->errors = null;
    }

    /**
     * @return bool
     */
    public function isError()
    {
        return !empty($this->errors);
    }

    /**
     * @param array $dbResponse
     * @return bool
     */
    protected function checkResult(array $dbResponse)
    {
        if (isset($dbResponse['errmsg'])) {
            $this->setErrors($dbResponse['errmsg']);
        }

        return isset($dbResponse['ok']) ? (bool)$dbResponse['ok'] : false;
    }
}