<?php
function set_notifikasi_swal($icon, $title, $text)
{
    session()->setFlashdata('swal_text', $text);
    session()->setFlashdata('swal_icon', $icon);
    session()->setFlashdata('swal_title', $title);
}