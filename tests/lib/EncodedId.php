<?php
/*
 * Copyright 2022 Cloud Creativity Limited
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types=1);

namespace LaravelJsonApi\CursorPagination\Tests;

use Illuminate\Support\Str;
use LaravelJsonApi\Contracts\Schema\ID;
use LaravelJsonApi\Contracts\Schema\IdEncoder;

class EncodedId implements ID, IdEncoder
{
    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return 'id';
    }

    /**
     * @inheritDoc
     */
    public function isSparseField(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function key(): ?string
    {
        // TODO: Implement key() method.
    }

    /**
     * @inheritDoc
     */
    public function pattern(): string
    {
        return '^TEST-';
    }

    /**
     * @inheritDoc
     */
    public function match(string $value): bool
    {
        return 1 === preg_match('/^TEST-/', $value);
    }

    /**
     * @inheritDoc
     */
    public function acceptsClientIds(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function isSortable(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function encode($modelKey): string
    {
        return "TEST-{$modelKey}";
    }

    /**
     * @inheritDoc
     */
    public function decode(string $resourceId)
    {
        return Str::after($resourceId, 'TEST-');
    }
}