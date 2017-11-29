<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

namespace Facebook\GFM;

use namespace HH\Lib\Str;

final class FencedCodeBlock extends FencedBlock {
  <<__Override>>
  protected static function getEndPatternForFirstLine(string $first): ?string {
    $matches = [];
    $result = \preg_match(
      '/^ {0,3}(?<fence>`{3,}|~{3,})( [^`]*)?$/',
      $first,
      $matches,
    );
    if ($result !== 1) {
      return null;
    }
    return '/^ {0,3}'.$matches['fence'].'+ *$/';
  }
}