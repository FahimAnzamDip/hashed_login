<?php

// Check if the GMP extension is enabled
if (!extension_loaded('gmp')) {
    die("The GMP extension is not enabled. Please enable it in your php.ini file.");
}

// Bitwise functions using GMP
function ROTR($x, $n)
{
    // Convert to GMP object
    $x = gmp_init($x);
    // Perform bitwise operations on GMP numbers
    $shiftedRight = gmp_div_q($x, gmp_pow(gmp_init(2), $n));
    $shiftedLeft = gmp_mul($x, gmp_pow(gmp_init(2), (64 - $n)));
    // Combined OR operation and limit to 64 bits
    $result = gmp_or($shiftedRight, $shiftedLeft);
    $mask = gmp_init('FFFFFFFFFFFFFFFF', 16);
    return gmp_and($result, $mask);
}

function SHR($x, $n)
{
    $x = gmp_init($x);
    return gmp_div_q($x, gmp_pow(gmp_init(2), $n));
}

function Ch($x, $y, $z)
{
    $x = gmp_init($x);
    $y = gmp_init($y);
    $z = gmp_init($z);
    return gmp_xor(gmp_and($x, $y), gmp_and(gmp_com($x), $z));
}

function Maj($x, $y, $z)
{
    $x = gmp_init($x);
    $y = gmp_init($y);
    $z = gmp_init($z);
    return gmp_xor(gmp_xor(gmp_and($x, $y), gmp_and($x, $z)), gmp_and($y, $z));
}

// SHA-512 Sigma functions
function bigSigma0($x)
{
    return gmp_xor(gmp_xor(ROTR($x, 28), ROTR($x, 34)), ROTR($x, 39));
}

function bigSigma1($x)
{
    return gmp_xor(gmp_xor(ROTR($x, 14), ROTR($x, 18)), ROTR($x, 41));
}

function smallSigma0($x)
{
    return gmp_xor(gmp_xor(ROTR($x, 1), ROTR($x, 8)), SHR($x, 7));
}

function smallSigma1($x)
{
    return gmp_xor(gmp_xor(ROTR($x, 19), ROTR($x, 61)), SHR($x, 6));
}

// Custom SHA-512 function
function sha512_custom($msg)
{
    $H = [
        gmp_init('6a09e667f3bcc908', 16), gmp_init('bb67ae8584caa73b', 16),
        gmp_init('3c6ef372fe94f82b', 16), gmp_init('a54ff53a5f1d36f1', 16),
        gmp_init('510e527fade682d1', 16), gmp_init('9b05688c2b3e6c1f', 16),
        gmp_init('1f83d9abfb41bd6b', 16), gmp_init('5be0cd19137e2179', 16)
    ];

    $K = [
        gmp_init('428a2f98d728ae22', 16),gmp_init('7137449123ef65cd', 16),gmp_init('b5c0fbcfec4d3b2f', 16),
        gmp_init('e9b5dba58189dbbc', 16),gmp_init('3956c25bf348b538', 16),gmp_init('59f111f1b605d019', 16),
        gmp_init('923f82a4af194f9b', 16),gmp_init('ab1c5ed5da6d8118', 16),gmp_init('d807aa98a3030242', 16),
        gmp_init('12835b0145706fbe', 16),gmp_init('243185be4ee4b28c', 16),gmp_init('550c7dc3d5ffb4e2', 16),
        gmp_init('72be5d74f27b896f', 16),gmp_init('80deb1fe3b1696b1', 16),gmp_init('9bdc06a725c71235', 16),
        gmp_init('c19bf174cf692694', 16),gmp_init('e49b69c19ef14ad2', 16),gmp_init('efbe4786384f25e3', 16),
        gmp_init('0fc19dc68b8cd5b5', 16),gmp_init('240ca1cc77ac9c65', 16),gmp_init('2de92c6f592b0275', 16),
        gmp_init('4a7484aa6ea6e483', 16),gmp_init('5cb0a9dcbd41fbd4', 16),gmp_init('76f988da831153b5', 16),
        gmp_init('983e5152ee66dfab', 16),gmp_init('a831c66d2db43210', 16),gmp_init('b00327c898fb213f', 16),
        gmp_init('bf597fc7beef0ee4', 16),gmp_init('c6e00bf33da88fc2', 16),gmp_init('d5a79147930aa725', 16),
        gmp_init('06ca6351e003826f', 16),gmp_init('142929670a0e6e70', 16),gmp_init('27b70a8546d22ffc', 16),
        gmp_init('2e1b21385c26c926', 16),gmp_init('4d2c6dfc5ac42aed', 16),gmp_init('53380d139d95b3df', 16),
        gmp_init('650a73548baf63de', 16),gmp_init('766a0abb3c77b2a8', 16),gmp_init('81c2c92e47edaee6', 16),
        gmp_init('92722c851482353b', 16),gmp_init('a2bfe8a14cf10364', 16),gmp_init('a81a664bbc423001', 16),
        gmp_init('c24b8b70d0f89791', 16),gmp_init('c76c51a30654be30', 16),gmp_init('d192e819d6ef5218', 16),
        gmp_init('d69906245565a910', 16),gmp_init('f40e35855771202a', 16),gmp_init('106aa07032bbd1b8', 16),
        gmp_init('19a4c116b8d2d0c8', 16),gmp_init('1e376c085141ab53', 16),gmp_init('2748774cdf8eeb99', 16),
        gmp_init('34b0bcb5e19b48a8', 16),gmp_init('391c0cb3c5c95a63', 16),gmp_init('4ed8aa4ae3418acb', 16),
        gmp_init('5b9cca4f7763e373', 16),gmp_init('682e6ff3d6b2b8a3', 16),gmp_init('748f82ee5defb2fc', 16),
        gmp_init('78a5636f43172f60', 16),gmp_init('84c87814a1f0ab72', 16),gmp_init('8cc702081a6439ec', 16),
        gmp_init('90befffa23631e28', 16),gmp_init('a4506cebde82bde9', 16),gmp_init('bef9a3f7b2c67915', 16),
        gmp_init('c67178f2e372532b', 16),gmp_init('ca273eceea26619c', 16),gmp_init('d186b8c721c0c207', 16),
        gmp_init('eada7dd6cde0eb1e', 16),gmp_init('f57d4f7fee6ed178', 16),gmp_init('06f067aa72176fba', 16),
        gmp_init('0a637dc5a2c898a6', 16),gmp_init('113f9804bef90dae', 16),gmp_init('1b710b35131c471b', 16),
        gmp_init('28db77f523047d84', 16),gmp_init('32caab7b40c72493', 16),gmp_init('3c9ebe0a15c9bebc', 16),
        gmp_init('431d67c49c100d4c', 16),gmp_init('4cc5d4becb3e42b6', 16),gmp_init('597f299cfc657e2a', 16),
        gmp_init('5fcb6fab3ad6faec', 16),gmp_init('6c44198c4a475817', 16)
    ];

    $msg = unpack('C*', $msg);
    $l = count($msg) * 8;

    // Convert to a proper 64-bit integer
    $l = gmp_init($l);

    $msg[] = 0x80;
    while ((count($msg) * 8) % 1024 != 896) {
        $msg[] = 0x00;
    }

    for ($i = 56; $i >= 0; $i -= 8) {
        $msg[] = gmp_intval(gmp_and(gmp_div_q($l, gmp_pow(gmp_init(2), $i)), gmp_init('FF', 16)));
    }

    $chunks = array_chunk($msg, 128);

    foreach ($chunks as $chunk) {
        $W = [];
        for ($i = 0; $i < 16; $i++) {
            $W[$i] = gmp_init(0);
            for ($j = 0; $j < 8; $j++) {
                if (isset($chunk[$i * 8 + $j])) {
                    $W[$i] = gmp_or(gmp_mul($W[$i], gmp_init(256)), gmp_init($chunk[$i * 8 + $j]));
                }
            }
        }

        for ($i = 16; $i < 80; $i++) {
            $W[$i] = gmp_add(gmp_add(gmp_add(smallSigma1($W[$i - 2]), $W[$i - 7]), smallSigma0($W[$i - 15])), $W[$i - 16]);
        }

        [$a, $b, $c, $d, $e, $f, $g, $h] = $H;

        for ($i = 0; $i < 80; $i++) {
            $T1 = gmp_add(gmp_add(gmp_add(gmp_add($h, bigSigma1($e)), Ch($e, $f, $g)), $K[$i]), $W[$i]);
            $T2 = gmp_add(bigSigma0($a), Maj($a, $b, $c));

            $h = $g;
            $g = $f;
            $f = $e;
            $e = gmp_add($d, $T1);
            $d = $c;
            $c = $b;
            $b = $a;
            $a = gmp_add($T1, $T2);
        }

        $H[0] = gmp_add($H[0], $a);
        $H[1] = gmp_add($H[1], $b);
        $H[2] = gmp_add($H[2], $c);
        $H[3] = gmp_add($H[3], $d);
        $H[4] = gmp_add($H[4], $e);
        $H[5] = gmp_add($H[5], $f);
        $H[6] = gmp_add($H[6], $g);
        $H[7] = gmp_add($H[7], $h);
    }

    return implode("", array_map(fn ($x) => str_pad(gmp_strval($x, 16), 16, "0", STR_PAD_LEFT), $H));
}
