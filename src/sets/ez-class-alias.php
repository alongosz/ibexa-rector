<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace RectorPrefix202211;

use Ibexa\Rector\Rules\Removing\Rector\RemoveEzClassAliasRector;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(RemoveEzClassAliasRector::class, []);
};
