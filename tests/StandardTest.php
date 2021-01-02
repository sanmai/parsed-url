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

namespace Tests\ParsedUrl;

use ParsedUrl\ParsedUrl;

/**
 * @covers \ParsedUrl\ParsedUrl
 */
class StandardTest extends TestCase
{
    public function testEmpty()
    {
        $url = new ParsedUrl('');

        $this->assertNull($url->scheme);
        $this->assertNull($url->host);
        $this->assertNull($url->user);
        $this->assertNull($url->pass);
        $this->assertNull($url->query);
        $this->assertNull($url->fragment);
        $this->assertObjectNotHasAttribute('foo', $url->query());

        $this->assertSame('', $url->path);
        $this->assertSame('', (string) $url);
    }

    public function testSimple()
    {
        $url = new ParsedUrl('https://www.example.com/index.html');

        $this->assertSame('https', $url->scheme);
        $this->assertSame('www.example.com', $url->host);
        $this->assertNull($url->user);
        $this->assertNull($url->pass);
        $this->assertSame('/index.html', $url->path);
        $this->assertSame('/index.html', (string) $url);
        $this->assertNull($url->query);
        $this->assertObjectNotHasAttribute('foo', $url->query());
        $this->assertNull($url->fragment);
    }

    public function testUserAndPassword()
    {
        $url = new ParsedUrl('https://foo:bar@www.example.com/');

        $this->assertSame('foo', $url->user);
        $this->assertSame('bar', $url->pass);
    }

    public function testQuery()
    {
        $url = new ParsedUrl('https://www.example.com/test?foo=bar&baz=1');

        $this->assertSame('/test', $url->path);
        $this->assertSame('foo=bar&baz=1', $url->query);
        $this->assertSame('/test?foo=bar&baz=1', (string) $url);

        $this->assertObjectHasAttribute('foo', $url->query());
        $this->assertObjectHasAttribute('baz', $url->query());

        $this->assertSame('bar', $url->query()->foo);
        $this->assertSame('1', $url->query()->baz);
    }
}
