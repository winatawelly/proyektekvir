#!/usr/bin/perl

$fin = '/etc/passwd';
$fout = '/tmp/std.out';
open(IN, $fin);
@lines = <IN>;
close(IN);
open(OUT, ">$fout");
foreach (@lines) {
    s/^([^:]*):([^:]*:){4}([^:]*).*/\1\t\3/;
    print OUT;
}
close(OUT);
