<?php
/**
 * This code is licensed under the MIT License.
 *
 * Copyright (c) 2016 Alexey Kopytko
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

declare(strict_types=1);

namespace ParsedUrl;

final class ParsedUrl implements Interfaces\ParsedUrl
{
    /** @var ?string */
    public $scheme;

    /** @var ?string */
    public $host;

    /** @var ?string */
    public $user;

    /** @var ?string */
    public $pass;

    /** @var string */
    public $path = '';

    /** @var ?string */
    public $query;

    /** @var ?string */
    public $fragment;

    public function __construct(string $url)
    {
        foreach (parse_url($url) as $key => $val) {
            $this->{$key} = $val;
        }
    }

    /** @var ?\stdClass */
    private $queryData;

    public function query(): \stdClass
    {
        if (null === $this->query) {
            return (object) [];
        }

        if (!isset($this->queryData)) {
            parse_str($this->query, $queryData);

            $this->queryData = (object) $queryData;
        }

        return $this->queryData;
    }

    public function __toString()
    {
        if (null === $this->query) {
            return $this->path;
        }

        return $this->path.'?'.$this->query;
    }
}
