<?php

namespace App\Repositories;

interface FileRepositoryInterface
{
    public function create(array $data);
    public function find($fileId);
    public function findFileWithGroup(array $fileIds, $groupId);
    public function updateFileStatus($fileId, $groupId, $status);
    public function findFileForGroupAndUser($fileId, $groupId, $userId);
    public function updateFile($file, array $data);
    public function findFileInGroupForUser($fileId, $groupId, $username);

}
