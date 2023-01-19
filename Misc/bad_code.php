<?php


class Foo
{
    static function bar()
    {
        return Bar::class;
    }
}

class Bar
{
    static $bar = Baz::class;
}

class Baz
{
    const qux = Qux::class;
}

class Qux
{
    public static function  quuz()
    {
        return Quuz::class;
    }
}


echo Foo::bar()::$bar::qux::quuz();
