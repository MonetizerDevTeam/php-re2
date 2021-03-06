--TEST--
re2 - null bytes
--SKIPIF--
<?php include('skipif.inc'); ?>
--FILE--
<?php

echo "*** Testing RE2 null bytes: match\n";
var_dump(re2_match("foo\x00(bar)", "foo\x00bar", $matches), $matches);

echo "*** Testing RE2 null bytes: match object\n";
var_dump(re2_match(new RE2("foo\x00(bar)"), "foo\x00bar", $matches), $matches);

echo "*** Testing RE2 null bytes: match_all\n";
var_dump(re2_match_all("foo\x00(bar)", "foo\x00barfoo\x00bar", $matches), $matches);

echo "*** Testing RE2 null bytes: replace\n";
var_dump(re2_replace("foo\x00(bar)", "\\1\x00hi", "foo\x00bar"));

echo "*** Testing RE2 null bytes: replace array\n";
var_dump(re2_replace("foo\x00(bar)", "\\1\x00hi", array("foo\x00bar", "barfoo\x00bar", "foobar")));

echo "*** Testing RE2 null bytes: replace_callback\n";
var_dump(re2_replace_callback("foo\x00(bar)", function ($m) { return strtoupper($m[1]) . "\x00hi"; }, "foo\x00bar"));

echo "*** Testing RE2 null bytes: filter\n";
var_dump(re2_filter("foo\x00(bar)", "\\1\x00hi", array("foo\x00bar", "barfoo\x00bar", "foobar")));

echo "*** Testing RE2 null bytes: grep\n";
var_dump(re2_grep("foo\x00(bar)", array("foo\x00bar", "barfoo\x00bar", "foobar")));

echo "*** Testing RE2 null bytes: quote\n";
var_dump(re2_quote("foo\x00(bar)"));

?>
--EXPECTF--
*** Testing RE2 null bytes: match
int(1)
array(2) {
  [0]=>
  string(7) "foo bar"
  [1]=>
  string(3) "bar"
}
*** Testing RE2 null bytes: match object
int(1)
array(2) {
  [0]=>
  string(7) "foo bar"
  [1]=>
  string(3) "bar"
}
*** Testing RE2 null bytes: match_all
int(2)
array(2) {
  [0]=>
  array(2) {
    [0]=>
    string(7) "foo bar"
    [1]=>
    string(7) "foo bar"
  }
  [1]=>
  array(2) {
    [0]=>
    string(3) "bar"
    [1]=>
    string(3) "bar"
  }
}
*** Testing RE2 null bytes: replace
string(6) "bar hi"
*** Testing RE2 null bytes: replace array
array(3) {
  [0]=>
  string(6) "bar hi"
  [1]=>
  string(9) "barbar hi"
  [2]=>
  string(6) "foobar"
}
*** Testing RE2 null bytes: replace_callback
string(6) "BAR hi"
*** Testing RE2 null bytes: filter
array(2) {
  [0]=>
  string(6) "bar hi"
  [1]=>
  string(9) "barbar hi"
}
*** Testing RE2 null bytes: grep
array(2) {
  [0]=>
  string(7) "foo bar"
  [1]=>
  string(10) "barfoo bar"
}
*** Testing RE2 null bytes: quote
string(14) "foo\x00\(bar\)"
