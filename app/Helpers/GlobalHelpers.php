<?php
use Hashids\Hashids;

function encodeToHash($id, $number = 11)
{
  $hashids = new Hashids(env('TRANSFER_KEY'), $number);
  return $hashids->encode($id);
}

function decodeToId($hash, $number = 11)
{
  $hashids = new Hashids(env('TRANSFER_KEY'), $number);
  return $hashids->decode($hash)[0];
}
