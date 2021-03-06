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

use type HHVM\UserDocumentation\UIGlyphIcon;

final class :ui:glyph extends :x:element {
  attribute UIGlyphIcon icon @required;

  protected function render(): XHPRoot {
    $class = "glyphIcon fa fa-".$this->:icon;
    return <i class={$class}></i>;
  }
}
