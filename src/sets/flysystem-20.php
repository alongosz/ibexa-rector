<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace RectorPrefix202211;

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\ClassConstFetch\RenameClassConstFetchRector;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Rector\Renaming\ValueObject\RenameClassAndConstFetch;

return static function (RectorConfig $rectorConfig): void {
    // partially taken from old rector/rector release
    $rectorConfig->ruleWithConfiguration(RenameMethodRector::class, [
        // Rename is now move, specific for files.
        new MethodCallRename('League\\Flysystem\\FilesystemInterface', 'rename', 'move'),
        // No arbitrary abbreviations
        new MethodCallRename('League\\Flysystem\\FilesystemInterface', 'createDir', 'createDirectory'),
        // Writes are now deterministic
        new MethodCallRename('League\\Flysystem\\FilesystemInterface', 'update', 'write'),
        new MethodCallRename('League\\Flysystem\\FilesystemInterface', 'updateStream', 'writeStream'),
        new MethodCallRename('League\\Flysystem\\FilesystemInterface', 'put', 'write'),
        new MethodCallRename('League\\Flysystem\\FilesystemInterface', 'putStream', 'writeStream'),
        // Metadata getters are renamed
        new MethodCallRename('League\\Flysystem\\FilesystemInterface', 'getTimestamp', 'lastModified'),
        new MethodCallRename('League\\Flysystem\\FilesystemInterface', 'has', 'fileExists'),
        new MethodCallRename('League\\Flysystem\\FilesystemInterface', 'getMimetype', 'mimeType'),
        new MethodCallRename('League\\Flysystem\\FilesystemInterface', 'getSize', 'fileSize'),
        new MethodCallRename('League\\Flysystem\\FilesystemInterface', 'getVisibility', 'visibility'),
        new MethodCallRename('League\\Flysystem\\FilesystemInterface', 'deleteDir', 'deleteDirectory'),
    ]);

    $rectorConfig->ruleWithConfiguration(
        RenameClassConstFetchRector::class,
        [new RenameClassAndConstFetch(
            'League\Flysystem\AdapterInterface',
            'VISIBILITY_PUBLIC',
            'League\Flysystem\Visibility',
            'PUBLIC'
        )]
    );

    $rectorConfig->ruleWithConfiguration(RenameClassRector::class, [
        'League\Flysystem\FilesystemInterface' => 'League\Flysystem\FilesystemOperator',
        'League\Flysystem\AdapterInterface' => 'League\Flysystem\Adapter',
        'League\Flysystem\FileExistsException' => 'League\Flysystem\FilesystemException',
        'League\Flysystem\FlysystemNotFoundException' => 'League\Flysystem\FilesystemException',
        'League\Flysystem\Adapter\Local' => 'League\Flysystem\Local\LocalFilesystemAdapter',
        'League\Flysystem\Memory\MemoryAdapter' => 'League\Flysystem\InMemory\InMemoryFilesystemAdapter',
        'Ibexa\Core\IO\Adapter\LocalAdapter' => 'Ibexa\Core\IO\Flysystem\Adapter\LocalSiteAccessAwareFilesystemAdapter',
    ]);
};
