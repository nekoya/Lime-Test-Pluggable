#!/usr/bin/perl
use strict;
use warnings;
use utf8;

use File::Find::Rule;

chdir('t');
my @files = File::Find::Rule->file()->name( qr/^\d\d\-[^\.]+\.php$/ )->in('.');
my $files;
my $errors;
for my $file ( @files ) {
    push @{ $files }, $file;
    my $amount;
    my $result = `php $file`;
    print "$file ... ";
    if ( $result =~ /^1\.\.(\d+)$/m ) {
        $amount = $1;
    }
    while ( $result =~ /^not ok (\d+)/gm ) {
        push @{ $errors->{ $file } }, $1;
    }
    if ( $errors->{ $file } ) {
        print "notok (", scalar @{ $errors->{ $file } }, "/$amount tests failed)\n";
    } else {
        print "ok ($amount tests passed)\n";
    }
}

if ( $errors ) {
    print "!!!! Failed tests !!!!\n";
    for my $file ( keys %{ $errors } ) {
        print $file, "\n";
        print "  Failed test ";
        print join ', ', @{ $errors->{ $file } };
        print "\n";
    }
} else {
    print "--- All test green ---\n";
}
